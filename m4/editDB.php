<?php
include 'connect.php';
$ALLOWED = [
    'Team'                  => ['Name','Stadium','Location'],
    'Team_Stats'            => ['Wins','Losses','Games_played','Win_percentage','Home_record','Away_record'],
    'Player'                => ['Name','Age','Weight','Height','Team_id','Position'],
    'Player_Stats'          => ['Points','Rebounds','Assists','Steals','Blocks','Turnovers','Field_goal_percentage','Three_point_percentage','Minutes'],
    'Player_Advanced_Stats' => ['True_shooting_percentage','Effective_field_goal_percentage','Usage_rate','Plus_minus','Per'],
];
function buildSet(array $changes, array $allowed): array {
    $fields = $vals = []; $types = '';
    foreach ($changes as $col => $val) {
        if (in_array($col, $allowed, true)) {
            $fields[] = "$col = ?";
            $vals[]   = $val;
            if (in_array($col, ['Age','Weight','Team_id','Minutes','Wins','Losses','Games_played','Plus_minus'], true)) {
                $types .= 'i';
            } elseif (in_array($col, ['Height','Points','Rebounds','Assists','Steals','Blocks','Turnovers','Field_goal_percentage','Three_point_percentage','True_shooting_percentage','Effective_field_goal_percentage','Usage_rate','Per','Win_percentage'], true)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
    }
    if (empty($fields)) throw new InvalidArgumentException("No valid columns to update.");
    return [implode(', ', $fields), $vals, $types];
}
function modifyItem(mysqli $conn, string $table, int $id, array $changes) {
    global $ALLOWED;
    if (!isset($ALLOWED[$table])) throw new InvalidArgumentException("Unknown table: $table");
    list($setClause, $values, $types) = buildSet($changes, $ALLOWED[$table]);
    $pk = in_array($table, ['Team','Team_Stats'], true) ? 'Team_id' : 'Player_id';
    $stmt = $conn->prepare("UPDATE `$table` SET $setClause WHERE `$pk` = ?");
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
    $types .= 'i';
    $values[] = $id;
    $stmt->bind_param($types, ...$values);
    if (!$stmt->execute()) throw new Exception("Execute failed: " . $stmt->error);
    $stmt->close();
}
function deleteItem(mysqli $conn, int $id, string $type) {
    $conn->begin_transaction();
    try {
        if ($type === 'Player') {
            $conn->query("DELETE FROM Player_Advanced_Stats WHERE Player_id = $id");
            $conn->query("DELETE FROM Player_Stats          WHERE Player_id = $id");
            $conn->query("DELETE FROM Player                WHERE Player_id = $id");
        } elseif ($type === 'Team') {
            $conn->query("DELETE FROM Team_Stats            WHERE Team_id   = $id");
            $conn->query("DELETE FROM Team                  WHERE Team_id   = $id");
        } else {
            throw new InvalidArgumentException("Invalid type for delete: $type");
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
}
function getNextId(mysqli $conn, string $table): int {
    $pk = $table . '_id';
    $res = $conn->query("SELECT MAX(`$pk`) AS max_id FROM `$table`");
    $row = $res->fetch_assoc();
    return (($row['max_id'] ?? 0) + 1);
}
function insertItem(mysqli $conn, int $id, string $type, array $data) {
    $conn->begin_transaction();
    try {
        if ($type === 'Player') {
            $stmt = $conn->prepare("INSERT INTO Player (Player_id, Name, Age, Weight, Height, Team_id, Position) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiiiss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO Player_Stats (Player_id, Points, Rebounds, Assists, Steals, Blocks, Turnovers, Field_goal_percentage, Three_point_percentage, Minutes) VALUES (?, 0,0,0,0,0,0,0,0,0)");
            $stmt->bind_param("i", $data[0]);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO Player_Advanced_Stats (Player_id, True_shooting_percentage, Effective_field_goal_percentage, Usage_rate, Plus_minus, Per) VALUES (?, 0,0,0,0,0)");
            $stmt->bind_param("i", $data[0]);
            $stmt->execute();
        } elseif ($type === 'Team') {
            $stmt = $conn->prepare("INSERT INTO Team (Team_id, Name, Stadium, Location) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $data[0], $data[1], $data[2], $data[3]);
            $stmt->execute();
            $stmt = $conn->prepare("INSERT INTO Team_Stats (Team_id, Wins, Losses, Games_played, Win_percentage, Home_record, Away_record) VALUES (?, 0, 0, 0, 0, '0', '0')");
            $stmt->bind_param("i", $data[0]);
            $stmt->execute();
        } else {
            throw new InvalidArgumentException("Invalid type for insert: $type");
        }
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
}
$formType = $_POST['formType'] ?? '';
$id       = intval($_POST['id'] ?? 0);
$type     = $_POST['type'] ?? '';
try {
    if ($formType === 'Delete' && $id > 0) {
        deleteItem($conn, $id, $type);
        header("Location: admin.html?deleted=1");
        exit;
    }
    if ($formType === 'Add' && ($type === 'Player' || $type === 'Team')) {
        $data = json_decode($_POST['data'] ?? '[]', true);
        $next = getNextId($conn, $type);
        array_unshift($data, $next);
        insertItem($conn, $next, $type, $data);
        header("Location: admin.html?added=1");
        exit;
    }
    if ($formType === 'Modify' && $id > 0) {
        if ($type === 'Player') {
            modifyItem($conn, 'Player',                $id, $_POST['Player']               ?? []);
            modifyItem($conn, 'Player_Stats',          $id, $_POST['Player_Stats']         ?? []);
            modifyItem($conn, 'Player_Advanced_Stats', $id, $_POST['Player_Advanced_Stats'] ?? []);
        } elseif ($type === 'Team') {
            modifyItem($conn, 'Team',       $id, $_POST['Team']      ?? []);
            modifyItem($conn, 'Team_Stats', $id, $_POST['Team_Stats'] ?? []);
        }
        header("Location: admin.html?modified=1");
        exit;
    }
    throw new Exception("Unknown formType or invalid data.");
} catch (Exception $e) {
    die("Error processing request: " . $e->getMessage());
}
?>
