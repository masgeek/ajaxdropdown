<?php
/**
 * Created by PhpStorm.
 * User: ANUBIS
 * Date: 11/1/2015
 * Time: 11:41 AM
 */

require_once 'mysqlconn.php';


$link->set_charset('utf8');


echo '<option value=" " selected>' . '--- Select Judge ---' . '</option>';

echo '<option value=" " >' . ' ' . '</option>';

echo '<option value="TBA" >' . '--- TBA ---' . '</option>';

$query = mysqli_query($link, "SELECT * FROM person WHERE IsJudge = 1 ORDER BY Province , Lastname , FirstName ");

$jsonArr = array(
    ['value' => '',
        'text' => '--- Select Judge ---'
    ],
    [
        'value' => 'TBA',
        'text' => '--- TBA ---'
    ]

); //this will hold the data we will echo as json
while ($row = mysqli_fetch_array($query)) {

    $memnum = $row['PersonID'];

    $surname = $row['LastName'];

    $fname = $row['FirstName'];

    $prov = $row['Province'];

    $div = $row['JudgingLevel'];

    $fullNames = $surname.", ".$fname; //combine the names
    $textValue = $surname.", ".$fname.", ".$prov.", ".$div;

    $jsonArr[] = [
        'value' => $fullNames,
        'text' => $textValue
    ];
    // echo "<option style='color: blue;' value='".$surname.",&nbsp;".$fname."'>".$surname.",&nbsp;".$fname.",&nbsp;".$prov.",&nbsp;".$div.'</option>';
    //lets combine the fields

}

//now echo this value as a json code
var_dump($jsonArr);