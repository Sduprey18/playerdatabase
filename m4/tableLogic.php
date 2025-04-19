<?php
require_once 'connect.php';

$formType = $_GET['formType'] ?? '';

/*
$sqlQuery = "SELECT Team_id FROM Team_Stats ORDER BY Wins DESC LIMIT 5";
$result = $conn->query($sqlQuery);

$topTeams = [];
while($row = $result->fetch_assoc()) {
    $teamId = $row['Team_id'];
    $secondQuery = "SELECT Name FROM Team where Team_id=$teamId";
    $secondResult = $conn->query($secondQuery);
    if ($teamRow = $secondResult->fetch_assoc()) {
        $topTeams[] = $teamRow['Name'];
    }
}*/
$sqlQuery = "
    SELECT 
        Team.Team_id, 
        Team.Name, 
        Team.Stadium, 
        Team.Location, 
        Team_Stats.Wins, 
        Team_Stats.Losses
    FROM Team_Stats
    JOIN Team ON Team_Stats.Team_id = Team.Team_id
    ORDER BY Team_Stats.Wins DESC
    LIMIT 5
";

$result = $conn->query($sqlQuery);

$topTeams = [];
while ($row = $result->fetch_assoc()) {
    $topTeams[] = $row; // Store the full row of info
}

$playerQuery ="SELECT 
                
";

#$topTeams = [];

while($row = $result->fetch_assoc()) {
    echo($row['name']."<br>");
}
if ($formType === 'topTeamsTable') {
    echo '
    <table border="10" class="center">
        <tr>
            <th>Name</th>
            <th>Wins</th>
            <th>Arena</th>
            <th>Location</th>
        </tr>';
        
foreach ($topTeams as $team) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($team['Name']) . '</td>';
    echo '<td>' . $team['Wins'] . '</td>';
    echo '<td>' . htmlspecialchars($team['Stadium']) . '</td>';
    echo '<td>' . htmlspecialchars($team['Location']) . '</td>';
    echo '</tr>';
}
echo '</table>';

} if ($formType === 'topPlayersTable') {

}



/// reading csv 
/*
$file = fopen('players.csv', 'r');
$line = fgetcsv($file, 0, ',','\\' );
while ($line != false){
    ///echo($line);
    print_r($line);
    $line = fgetcsv($file, 0, ','"'\\' );
    
}
fclose($file);
*/



///writing to csv 
/*
$file = fopen("csv.name", "a");

fputcsv($file,["thing x", "thing x+1", "thing xxx..."]);

fclose($file);

*/
?>