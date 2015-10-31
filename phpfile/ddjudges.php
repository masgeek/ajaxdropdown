<?php
/**
 * Created by PhpStorm.
 * User: ANUBIS
 * Date: 10/31/2015
 * Time: 4:48 PM
 */

require_once "medoo.php"; //we use this as the ORM tool to query databases
//im too lazy to write long queries

//
//

$db = new medoo([
    'database_type' => 'mysql',
    'database_name' => '',
    'server' => 'localhost',
    'username' => '',
    'password' => '',
    'charset' => 'utf8'
]);

$selectedJudge = isset($_POST['judgename'])? $_POST['judgename'] :'';

//now lets query the database
//query is similar to
//SELECT judge_name from judges_table where judge_name not in ($seelctedjudge);

$judgedata = $db->select('judges_table',
    [
        'judge_name'
    ],
    [
        'judge_name[!]'=>$selectedJudge
    ]
);

//var_dump($judgedata);
//return the data as json encoded data
$resp = json_encode($judgedata);

print_r($resp);