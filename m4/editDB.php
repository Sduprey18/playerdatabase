<?PHP
include 'connect.php';


$formType = $_POST['formType'] ?? '';
$id       = intval($_POST['id'] ?? 0);
$type     = $_POST['type'] ?? '';

if ($formType === "Delete" && $id > 0 && ($type === "Player" || $type === "Team")) {
    deleteItem($conn, $id, $type);
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
    if ($type=="Player"){
        $sql = "DELETE FROM Player WHERE Player_id=$id";
        $conn->query($sql);
        $sql = "DELETE FROM Player_Stats WHERE Player_id=$id";
        $conn->query($sql);
        $sql = "DELETE FROM Player_Advanced_Stats WHERE Player_id=$id";
        $conn->query($sql);
    }     
    if ($type=="Team"){
        $sql = "DELETE FROM Team WHERE Team_id=$id";
        $conn->query($sql);
        $sql = "DELETE FROM Team_Stats WHERE Team_id=$id";
        $conn->query($sql);
    }
}

function insert($conn, $id, $type, $inputString){
    if($type== "Player"){
        $sql = "INSERT INTO Player (Player_id, Name, Age, Weight, Height, Team_id, Position) 
            VALUES ($inputString[0], $inputString[1], $inputString[2], $inputString[3], $inputString[4], $inputString[5], $inputString[6])";
        $conn->query($sql);
        $sql = "INSERT INTO Player_Stats (Player_id, Points, Rebounds, Assists, Steals, Blocks, Turnovers, Field_goal_percentage, Three_point_percentage, Minutes) 
            VALUES ($inputString[0], 0,0,0,0,0,0,0,0,0)";
        $conn->query($sql);
        $sql = "INSERT INTO Player_Advanced_Stats (Player_id,True_shooting_percentage ,Effective_field_goal_percentage ,Usage_rate ,Plus_minus ,Per) 
            VALUES ($inputString[0], 0,0,0,0,0)";
        $conn->query($sql);

    }
    if($type=="Team"){
        $sql ="INSERT INTO TEAM (Team_id, Name, Stadium, Location)
             VALUES ($inputString[0], $inputString[1], $inputString[2], $inputString[3])"; 
        $conn->query($sql);
        $sql ="INSERT INTO TEAM_Stats (Team_id, Wins, Losses, Games_played, Win_percentage, Home_record, Away_record)
             VALUES ($inputString[0], 0, 0, 0,0,'0','0')";
        $conn->query($sql);
    }
}

/*
function modify($conn, $id, $type, $input) {
    do
}*/


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

    $types = str_repeat('s', count($vals));   // all as strings for brevity
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