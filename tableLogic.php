<?php


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

$file = fopen('players.csv', 'r');
///$line = fgetcsv($file);

$line = fgetcsv($file, 0, ',', '"', '\\');

while ($line != false){
    $player = $line[1];
    $pos = $line[6];

    echo("The player is $player at $pos \n");

    $line = fgetcsv($file, 0, ',', '"', '\\');

}
fclose($file);


///writing to csv 
/*
$file = fopen("csv.name", "a");

fputcsv($file,["thing x", "thing x+1", "thing xxx..."]);

fclose($file);

*/
?>