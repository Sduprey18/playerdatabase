<?php
include 'connect.php';

$type = $_GET['type'] ?? '';
$id = intval($_GET['id'] ?? 0);

if (!$type || !$id) {
    die("Invalid parameters");
}

if ($type === 'Player') {
    $stmt = $conn->prepare("SELECT * FROM Player WHERE Player_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $player = $stmt->get_result()->fetch_assoc();
    
    $stmt = $conn->prepare("SELECT * FROM Player_Stats WHERE Player_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $playerStats = $stmt->get_result()->fetch_assoc();
    
    $stmt = $conn->prepare("SELECT * FROM Player_Advanced_Stats WHERE Player_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $playerAdvancedStats = $stmt->get_result()->fetch_assoc();
    
} elseif ($type === 'Team') {
    $stmt = $conn->prepare("SELECT * FROM Team WHERE Team_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $team = $stmt->get_result()->fetch_assoc();
    
    $stmt = $conn->prepare("SELECT * FROM Team_Stats WHERE Team_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $teamStats = $stmt->get_result()->fetch_assoc();
} else {
    die("Invalid type");
}

if (!$player && !$team) {
    die("Item not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $type; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .stats-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <a href="admin.html" class="back-link">← Back to Admin Dashboard</a>
    <h1>Edit <?php echo $type; ?></h1>
    
    <form action="editDB.php" method="POST">
        <input type="hidden" name="formType" value="Modify">
        <input type="hidden" name="type" value="<?php echo $type; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <?php if ($type === 'Player'): ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="Player[Name]" value="<?php echo htmlspecialchars($player['Name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="Player[Age]" value="<?php echo $player['Age']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="weight">Weight (lbs):</label>
                <input type="number" id="weight" name="Player[Weight]" value="<?php echo $player['Weight']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="height">Height (inches):</label>
                <input type="number" id="height" name="Player[Height]" value="<?php echo $player['Height']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="team_id">Team ID:</label>
                <input type="number" id="team_id" name="Player[Team_id]" value="<?php echo $player['Team_id']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" id="position" name="Player[Position]" value="<?php echo htmlspecialchars($player['Position']); ?>" required>
            </div>

            <div class="stats-section">
                <h2>Player Stats</h2>
                <div class="form-group">
                    <label for="points">Points:</label>
                    <input type="number" id="points" name="Player_Stats[Points]" value="<?php echo $playerStats['Points']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="rebounds">Rebounds:</label>
                    <input type="number" id="rebounds" name="Player_Stats[Rebounds]" value="<?php echo $playerStats['Rebounds']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="assists">Assists:</label>
                    <input type="number" id="assists" name="Player_Stats[Assists]" value="<?php echo $playerStats['Assists']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="steals">Steals:</label>
                    <input type="number" id="steals" name="Player_Stats[Steals]" value="<?php echo $playerStats['Steals']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="blocks">Blocks:</label>
                    <input type="number" id="blocks" name="Player_Stats[Blocks]" value="<?php echo $playerStats['Blocks']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="turnovers">Turnovers:</label>
                    <input type="number" id="turnovers" name="Player_Stats[Turnovers]" value="<?php echo $playerStats['Turnovers']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="fg_percentage">Field Goal Percentage:</label>
                    <input type="number" step="0.01" id="fg_percentage" name="Player_Stats[Field_goal_percentage]" value="<?php echo $playerStats['Field_goal_percentage']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="three_percentage">Three Point Percentage:</label>
                    <input type="number" step="0.01" id="three_percentage" name="Player_Stats[Three_point_percentage]" value="<?php echo $playerStats['Three_point_percentage']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="minutes">Minutes:</label>
                    <input type="number" id="minutes" name="Player_Stats[Minutes]" value="<?php echo $playerStats['Minutes']; ?>" required>
                </div>
            </div>

            <div class="stats-section">
                <h2>Advanced Stats</h2>
                <div class="form-group">
                    <label for="ts_percentage">True Shooting Percentage:</label>
                    <input type="number" step="0.01" id="ts_percentage" name="Player_Advanced_Stats[True_shooting_percentage]" value="<?php echo $playerAdvancedStats['True_shooting_percentage']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="efg_percentage">Effective Field Goal Percentage:</label>
                    <input type="number" step="0.01" id="efg_percentage" name="Player_Advanced_Stats[Effective_field_goal_percentage]" value="<?php echo $playerAdvancedStats['Effective_field_goal_percentage']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="usage_rate">Usage Rate:</label>
                    <input type="number" step="0.01" id="usage_rate" name="Player_Advanced_Stats[Usage_rate]" value="<?php echo $playerAdvancedStats['Usage_rate']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="plus_minus">Plus/Minus:</label>
                    <input type="number" id="plus_minus" name="Player_Advanced_Stats[Plus_minus]" value="<?php echo $playerAdvancedStats['Plus_minus']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="per">Player Efficiency Rating:</label>
                    <input type="number" step="0.01" id="per" name="Player_Advanced_Stats[Per]" value="<?php echo $playerAdvancedStats['Per']; ?>" required>
                </div>
            </div>
            
        <?php elseif ($type === 'Team'): ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="Team[Name]" value="<?php echo htmlspecialchars($team['Name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="stadium">Stadium:</label>
                <input type="text" id="stadium" name="Team[Stadium]" value="<?php echo htmlspecialchars($team['Stadium']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="Team[Location]" value="<?php echo htmlspecialchars($team['Location']); ?>" required>
            </div>

            <div class="stats-section">
                <h2>Team Stats</h2>
                <div class="form-group">
                    <label for="wins">Wins:</label>
                    <input type="number" id="wins" name="Team_Stats[Wins]" value="<?php echo $teamStats['Wins']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="losses">Losses:</label>
                    <input type="number" id="losses" name="Team_Stats[Losses]" value="<?php echo $teamStats['Losses']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="games_played">Games Played:</label>
                    <input type="number" id="games_played" name="Team_Stats[Games_played]" value="<?php echo $teamStats['Games_played']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="win_percentage">Win Percentage:</label>
                    <input type="number" step="0.01" id="win_percentage" name="Team_Stats[Win_percentage]" value="<?php echo $teamStats['Win_percentage']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="home_record">Home Record:</label>
                    <input type="text" id="home_record" name="Team_Stats[Home_record]" value="<?php echo $teamStats['Home_record']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="away_record">Away Record:</label>
                    <input type="text" id="away_record" name="Team_Stats[Away_record]" value="<?php echo $teamStats['Away_record']; ?>" required>
                </div>
            </div>
        <?php endif; ?>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html> 