<?PHP

require_once "connect.php";

///HOW TO READ FROM SQL DB: 
$sqlQuery = "SELECT name FROM Player";
$result = $conn->query($sqlQuery);

while($row = $result->fetch_assoc()) {
    echo($row['name']."<br>");
}

/*HOW TO INSERT INTO SQL DB:
$sql = "INSERT INTO Player (Player_id, Name, Age, Weight, Height, Team_id, Position) 
VALUES (99, 'Sherkeem Duprey', 21, 145, 5.9, 2, 'PG')";

$conn->query($sql);
*/

/*///HOW TO UPDATE THE SQL DB:
$sql = "UPDATE Player SET Age=22 WHERE Name = 'Sherkeem Duprey'";
$conn->query($sql);
*/

///HOW TO DELETE FROM SQL DB: 
$sql = "DELETE FROM Player WHERE Player_id=99";
$conn->query($sql);

?>