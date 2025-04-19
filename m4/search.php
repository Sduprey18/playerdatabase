<?php
include 'connect.php';

$q = $_GET['q'] ?? '';
$q = trim($q);

if ($q === '') {
    echo "<p>Type to search for players or teams...</p>";
    exit;
}

// Prepare query to search both Player and Team tables
$escaped = $conn->real_escape_string($q);

$sql = "
    (SELECT 'Player' AS type, Name AS name FROM Player WHERE Name LIKE '%$escaped%')
    UNION
    (SELECT 'Team' AS type, Name AS name FROM Team WHERE Name LIKE '%$escaped%')
    LIMIT 10
";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "<p>No results found.</p>";
} else {
    while ($row = $result->fetch_assoc()) {
    $type = $row['type'];
    $name = htmlspecialchars($row['name'], ENT_QUOTES);
    
    echo "<button 
            class='search-button' 
            type='button'      
            data-type='$type' 
            data-name=\"$name\">
            $type: $name
          </button>";
}

}

?>
