<?php
include 'connect.php';

$type = $_GET['type'] ?? '';
$name = $_GET['name'] ?? '';

if ($type === 'Player') {
    $stmt = $conn->prepare("SELECT * FROM Player JOIN Player_Stats ON Player.Player_id = Player_Stats.Player_id WHERE Player.Name = ?");
} elseif ($type === 'Team') {
    $stmt = $conn->prepare("SELECT * FROM Team JOIN Team_Stats ON Team.Team_id = Team_Stats.Team_id WHERE Team.Name = ?");
} else {
    echo "Invalid type.";
    exit;
}

$isAdmin = isset($_GET['admin']) && $_GET['admin'] === 'true';

$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "<h2>{$row['Name']}</h2>";
    
    if ($type === 'Player') {
        echo "<p><strong>Points:</strong> {$row['Points']}</p>";
        echo "<p><strong>Rebounds:</strong> {$row['Rebounds']}</p>";
        echo "<p><strong>Assists:</strong> {$row['Assists']}</p>";
        echo "<p><strong>Minutes:</strong> {$row['Minutes']}</p>";
    } elseif ($type === 'Team') {
        echo "<p><strong>Wins:</strong> {$row['Wins']}</p>";
        echo "<p><strong>Losses:</strong> {$row['Losses']}</p>";
        echo "<p><strong>Stadium:</strong> {$row['Stadium']}</p>";
        echo "<p><strong>Location:</strong> {$row['Location']}</p>";
    }
    
    
    echo "<input type='hidden' id='item-id' value='{$row[$type . '_id']}'>";
} else {
    echo "No info found.";
}
?>
