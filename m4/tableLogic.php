<?php
require_once 'connect.php';

$formType = $_GET['formType'] ?? '';

switch ($formType) {
    case 'topTeamsTable':
        $sql = "
            SELECT
                t.Name,
                ts.Wins,
                ts.Losses,
                t.Stadium,
                t.Location
            FROM Team_Stats AS ts
            JOIN Team      AS t  ON t.Team_id = ts.Team_id
            ORDER BY ts.Wins DESC
            LIMIT 5
        ";
        if (!($result = $conn->query($sql))) {
            die("Query failed: " . $conn->error);
        }
        echo '<table class="center" border="10">
                <tr>
                  <th>Name</th>
                  <th>Wins</th>
                  <th>Losses</th>
                  <th>Arena</th>
                  <th>Location</th>
                </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>',
                 '<td>' . htmlspecialchars($row['Name']) . '</td>',
                 '<td>' . intval($row['Wins']) . '</td>',
                 '<td>' . intval($row['Losses']) . '</td>',
                 '<td>' . htmlspecialchars($row['Stadium']) . '</td>',
                 '<td>' . htmlspecialchars($row['Location']) . '</td>',
                 '</tr>';
        }
        echo '</table>';
        break;

    case 'topPlayersTable':
        $sql = "
            SELECT
                p.Name,
                ps.Points,
                ps.Rebounds,
                ps.Assists,
                ps.Minutes
            FROM Player_Stats AS ps
            JOIN Player       AS p  ON p.Player_id = ps.Player_id
            ORDER BY ps.Points DESC
            LIMIT 5
        ";
        if (!($result = $conn->query($sql))) {
            die("Query failed: " . $conn->error);
        }
        echo '<table class="center" border="10">
                <tr>
                  <th>Name</th>
                  <th>Points</th>
                  <th>Rebounds</th>
                  <th>Assists</th>
                  <th>Minutes</th>
                </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>',
                 '<td>' . htmlspecialchars($row['Name']) . '</td>',
                 '<td>' . intval($row['Points']) . '</td>',
                 '<td>' . intval($row['Rebounds']) . '</td>',
                 '<td>' . intval($row['Assists']) . '</td>',
                 '<td>' . intval($row['Minutes']) . '</td>',
                 '</tr>';
        }
        echo '</table>';
        break;

    case 'advancedStatsTable':
        $sql = "
            SELECT
                p.Name,
                pas.True_shooting_percentage,
                pas.Effective_field_goal_percentage,
                pas.Usage_rate,
                pas.Plus_minus,
                pas.Per
            FROM Player_Advanced_Stats AS pas
            JOIN Player               AS p   ON p.Player_id = pas.Player_id
            ORDER BY pas.Per DESC
            LIMIT 5
        ";
        if (!($result = $conn->query($sql))) {
            die("Query failed: " . $conn->error);
        }
        echo '<table class="center" border="10">
                <tr>
                  <th>Name</th>
                  <th>True Shooting %</th>
                  <th>Effective FG %</th>
                  <th>Usage Rate %</th>
                  <th>Plus/Minus</th>
                  <th>PER</th>
                </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>',
                 '<td>' . htmlspecialchars($row['Name']) . '</td>',
                 '<td>' . number_format($row['True_shooting_percentage'] * 100, 1)   . '%</td>',
                 '<td>' . number_format($row['Effective_field_goal_percentage'] * 100, 1) . '%</td>',
                 '<td>' . number_format($row['Usage_rate'] * 100, 1)                . '%</td>',
                 '<td>' . intval($row['Plus_minus'])                                . '</td>',
                 '<td>' . number_format($row['Per'], 1)                             . '</td>',
                 '</tr>';
        }
        echo '</table>';
        break;

    case 'teamStatsTable':
        $sql = "
            SELECT
                t.Name,
                ts.Wins,
                ts.Losses,
                ts.Games_played,
                ts.Win_percentage
            FROM Team_Stats AS ts
            JOIN Team      AS t   ON t.Team_id = ts.Team_id
            ORDER BY ts.Wins DESC
            LIMIT 5
        ";
        if (!($result = $conn->query($sql))) {
            die("Query failed: " . $conn->error);
        }
        echo '<table class="center" border="10">
                <tr>
                  <th>Name</th>
                  <th>Wins</th>
                  <th>Losses</th>
                  <th>Games Played</th>
                  <th>Win %</th>
                </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>',
                 '<td>' . htmlspecialchars($row['Name']) . '</td>',
                 '<td>' . intval($row['Wins']) . '</td>',
                 '<td>' . intval($row['Losses']) . '</td>',
                 '<td>' . intval($row['Games_played']) . '</td>',
                 '<td>' . number_format($row['Win_percentage'] * 100, 1) . '%</td>',
                 '</tr>';
        }
        echo '</table>';
        break;

    default:
        echo '<p>No table selected.</p>';
        break;
}
?>