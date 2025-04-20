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
    $topTeams[] = $row;
}

/*
$playerQuery ="SELECT 
                Player_Stats.Player_id,
                Player.Name,
                Player_Stats.Points,
                Player_Stats.Rebounds,
                Player_Stats.Assists,
                Player_Stats.Minutes
                FROM Player_Stats
                JOIN Player ON Player.Player_id = Player_Stats.Player_id
                ORDER BY Player_Stats.Points DESC
                LIMIT 5
";*/

$playerQuery = "SELECT
    Player_Stats.Player_id,
    Player.Name,
    Player_Stats.Points,
    Player_Stats.Rebounds,
    Player_Stats.Assists,
    Player_Stats.Minutes,
    Player_Advanced_Stats.True_shooting_percentage,
    Player_Advanced_Stats.Plus_minus,
    Player_Advanced_Stats.Per
FROM Player_Stats
JOIN Player ON Player.Player_id = Player_Stats.Player_id
JOIN Player_Advanced_Stats ON Player_Stats.Player_id = Player_Advanced_Stats.Player_id
ORDER BY Player_Stats.Points DESC
LIMIT 5";


$playerResult = $conn->query($playerQuery);


$topPlayers = [];
while ($row = $playerResult->fetch_assoc()) {
    $topPlayers[] = $row; 
}


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
    echo ' <table class="center" border="10">
                    <tr>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Rebounds</th>
                        <th>Assists</th>
                        <th>Minutes</th>
                        <th>TS%</th>
                        <th>-+</th>
                        <th>PER</th>
                    </tr>';
    foreach ($topPlayers as $player) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($player['Name']) . '</td>';
    echo '<td>' . $player['Points'] . '</td>';
    echo '<td>' . htmlspecialchars($player['Rebounds']) . '</td>';
    echo '<td>' . htmlspecialchars($player['Assists']) . '</td>';
    echo '<td>' . htmlspecialchars($player['Minutes']) . '</td>';
    echo '<td>' . htmlspecialchars($player['True_shooting_percentage']) . '</td>';
    echo '<td>' . htmlspecialchars($player['Plus_minus']) . '</td>';
    echo '<td>' . htmlspecialchars($player['Per']) . '</td>';
    echo '</tr>';
}
    echo '</table>';

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