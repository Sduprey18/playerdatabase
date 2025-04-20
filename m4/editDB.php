<?PHP
include 'connect.php';

$formType = $_POST['formType'] ?? '';
$id = intval($_POST['id'] ?? 0);
$type = $_POST['type'] ?? '';

if ($formType === "Delete" && $id > 0 && ($type === "Player" || $type === "Team")) {
    deleteItem($conn, $id, $type);
}

if ($formType === "Add" && ($type === "Player" || $type === "Team")) {
    $data = json_decode($_POST['data'] ?? '[]', true);
    if ($type === "Player" && count($data) === 6) {
        $nextId = getNextId($conn, 'Player');
        $data = array_merge([$nextId], $data);
        insert($conn, $nextId, $type, $data);
    } elseif ($type === "Team" && count($data) === 3) {
        $nextId = getNextId($conn, 'Team');
        $data = array_merge([$nextId], $data);
        insert($conn, $nextId, $type, $data);
    }
}

function getNextId($conn, $table) {
    $sql = "SELECT MAX({$table}_id) as max_id FROM $table";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return ($row['max_id'] ?? 0) + 1;
}

$ALLOWED = [
    'Team' => ['Name','Stadium','Location'],
    'Team_Stats' => [
        'Wins','Losses','Games_played','Win_percentage',
        'Home_record','Away_record'
    ],
    'Player' => [
        'Name','Age','Weight','Height','Team_id','Position'
    ],
    'Player_Stats' => [
        'Points','Rebounds','Assists','Steals','Blocks',
        'Turnovers','Field_goal_percentage',
        'Three_point_percentage','Minutes'
    ],
    'Player_Advanced_Stats' => [
        'True_shooting_percentage','Effective_field_goal_percentage',
        'Usage_rate','Plus_minus','Per'
    ],
];

function deleteItem($conn, $id, $type){
    $conn->begin_transaction();
    
    try {
        if ($type == "Player") {
            $sql = "DELETE FROM Player_Advanced_Stats WHERE Player_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $sql = "DELETE FROM Player_Stats WHERE Player_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $sql = "DELETE FROM Player WHERE Player_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }     
        else if ($type == "Team") {
            $sql = "DELETE FROM Team_Stats WHERE Team_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $sql = "DELETE FROM Team WHERE Team_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        
        $conn->commit();
        return true;
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Error deleting item: " . $e->getMessage());
        return false;
    }
}

function insert($conn, $id, $type, $inputString){
    $conn->begin_transaction();
    
    try {
        if($type == "Player"){
            $sql = "INSERT INTO Player (Player_id, Name, Age, Weight, Height, Team_id, Position) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isiiiss", $inputString[0], $inputString[1], $inputString[2], $inputString[3], $inputString[4], $inputString[5], $inputString[6]);
            $stmt->execute();
            
            $sql = "INSERT INTO Player_Stats (Player_id, Points, Rebounds, Assists, Steals, Blocks, Turnovers, Field_goal_percentage, Three_point_percentage, Minutes) VALUES (?, 0,0,0,0,0,0,0,0,0)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $inputString[0]);
            $stmt->execute();
            
            $sql = "INSERT INTO Player_Advanced_Stats (Player_id, True_shooting_percentage, Effective_field_goal_percentage, Usage_rate, Plus_minus, Per) VALUES (?, 0,0,0,0,0)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $inputString[0]);
            $stmt->execute();
        }
        else if($type == "Team"){
            $sql = "INSERT INTO Team (Team_id, Name, Stadium, Location) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $inputString[0], $inputString[1], $inputString[2], $inputString[3]);
            $stmt->execute();
            
            $sql = "INSERT INTO Team_Stats (Team_id, Wins, Losses, Games_played, Win_percentage, Home_record, Away_record) VALUES (?, 0, 0, 0, 0, '0', '0')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $inputString[0]);
            $stmt->execute();
        }
        
        $conn->commit();
        return true;
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Error inserting item: " . $e->getMessage());
        return false;
    }
}

function buildSet(array $changes, array $allowed): array
{
    $fields = $vals = [];
    foreach ($changes as $col => $val) {
        if (in_array($col, $allowed, true)) {
            $fields[] = "$col = ?";
            $vals[]   = $val;
        }
    }
    if (!$fields) { throw new InvalidArgumentException("No valid columns"); }

    $types = str_repeat('s', count($vals));   
    return [implode(', ', $fields), $vals, $types];
}

function modifyItem(mysqli $conn, string $table, int $id, array $changes)
{
    global $ALLOWED;                       

    if (!isset($ALLOWED[$table])) {
        throw new InvalidArgumentException("Unknown table $table");
    }

    [$set, $vals, $types] = buildSet($changes, $ALLOWED[$table]);
   
    $pk = ($table === 'Team' || $table === 'Team_Stats') ? 'Team_id' : 'Player_id';

    $sql = "UPDATE $table SET $set WHERE $pk = ?";
    $stmt = $conn->prepare($sql);
  
    $types .= 'i';
    $vals[]  = $id;

    $stmt->bind_param($types, ...$vals);
    $stmt->execute();
}
?>