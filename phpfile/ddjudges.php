<?php
/**
 * Created by PhpStorm.
 * User: ANUBIS
 * Date: 11/1/2015
 * Time: 11:41 AM
 */

require_once 'mysqlconn.php';


$link->set_charset('utf8');

$selectedJudge = isset($_POST['judgename'])? $_POST['judgename'] :'EMPTY';


//this is used to filter selected judge
//CONCAT_WS(', ',LastName,FirstName) NOT IN('Ben, Judge')

$filterQuery = "SELECT * FROM person WHERE IsJudge = 1 AND CONCAT_WS(', ',LastName,FirstName) NOT IN('$selectedJudge') ORDER BY Province , Lastname , FirstName";


//var_dump($filterQuery);
//"SELECT * FROM person WHERE IsJudge = 1 ORDER BY Province , Lastname , FirstName "

//die;
$query = mysqli_query($link, $filterQuery);

//if this [] fails replace with array()
$jsonArr = array(
    array('value' => '',
        'text' => '--- Select Judge ---'
    ),
    array(
        'value' => 'TBA',
        'text' => '--- TBA ---'
    )

); //this will hold the data we will echo as json
while ($row = mysqli_fetch_array($query)) {

    $memnum = $row['PersonID'];

    $surname = $row['LastName'];

    $fname = $row['FirstName'];

    $prov = $row['Province'];

    $div = $row['JudgingLevel'];

    $fullNames = $surname.", ".$fname; //combine the names
    $textValue = $surname.", ".$fname.", ".$prov.", ".$div;

    //add the combine fieds to json array
    $jsonArr[] = array(
        'value' => $fullNames,
        'text' => $textValue
    );
    // echo "<option style='color: blue;' value='".$surname.",&nbsp;".$fname."'>".$surname.",&nbsp;".$fname.",&nbsp;".$prov.",&nbsp;".$div.'</option>';
    //lets combine the fields

}

echo json_encode($jsonArr);
