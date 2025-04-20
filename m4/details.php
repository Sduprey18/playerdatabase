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
    if ($isAdmin) {
        
        echo "
        <form action='editDB.php' method='POST' style='margin-top:1em;'>
          <input type='hidden' name='formType' value='Delete'>
          <input type='hidden' name='id'        value='{$row[$type . '_id']}'>
          <input type='hidden' name='type'      value='$type'>
          <button type='submit' style='background:crimson;color:white;padding:8px;border:none;border-radius:4px;'>
            Delete $type
          </button>
        </form>";

        
        echo "
        <a href='editForm.php?type=$type&id={$row[$type . '_id']}' 
           style='display:inline-block;margin-top:0.5em;padding:8px 12px;background:#007bff;color:#fff;text-decoration:none;border-radius:4px;'>
          Edit $type
        </a>";
    }
} else {
    echo "No info found.";
}
?>
