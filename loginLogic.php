<?PHP 

/*
$username = $_POST['username'];
$password = $_POST['password'];
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if ($_POST['formType'] === 'login'){
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];
        checkCredentials($username,$password);

    }
    if ($_POST['formType'] === 'signup'){
        $username = $_POST['signinUsername'];
        $password = $_POST['signinPassword'];
        createUser($username, $password);
    }
}

function createUser($username, $password){
    /*
    $file = fopen("users.csv", "a");
    fputcsv($file,[$username,$password]);
    fclose($file);
    */

    $jsonData = file_get_contents('users.json');

    $data = json_decode($jsonData,true);

    $data[$username] = $password;

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    file_put_contents("users.json", $jsonData);
    header("Location: admin.html");
}

function checkCredentials($username, $password){

    $jsonData = file_get_contents('users.json');

    $data = json_decode($jsonData,true);

    if (in_array($username, $data)){
        if ($password === $data[$username]){
            header("Location: admin.html");
        }
    } else {
        echo "username not in thing";
    }

    
    
}

///writing to csv 
/*
$file = fopen("csv.name", "a");

fputcsv($file,["thing x", "thing x+1", "thing xxx..."]);

fclose($file);

*/

/*
Writing to json:
step 1, create hahsmap:
$data = [
    "value1" => "value2"
];

step 2, convert the array to a json string
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

step 3, actually write to the file
file_put_contents("filename.json", $jsonData) 
*/

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

?>