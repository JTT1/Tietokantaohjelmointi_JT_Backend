<?php
require_once "inc/functions.php";
require_once "inc/headers.php";

$input = json_decode(file_get_contents('PHP://input'));
$ttnimi = filter_var($input->ttnimi,FILTER_SANITIZE_STRING);
$ttsposti = filter_var($input->ttsposti,FILTER_SANITIZE_STRING);
$ttpuhnro = filter_var($input->ttpuhnro,FILTER_SANITIZE_STRING);
$ttosoite = filter_var($input->ttosoite,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $db->beginTransaction();

    $sql = "INSERT into tyontekija(nimi, sposti, puhnro, osoite) values
        ('" .  
        filter_var($ttnimi,FILTER_SANITIZE_STRING) . "','" . 
        filter_var($ttsposti,FILTER_SANITIZE_STRING) . "','" . 
        filter_var($ttpuhnro,FILTER_SANITIZE_STRING) . "','" . 
        filter_var($ttosoite,FILTER_SANITIZE_STRING)
    .   "')";

    $query = $db->prepare($sql);
    $query->execute();

    $db->commit();
    header("HTTP/1.1 200 OK");
    
    $data = array("status" => "ok");
    echo json_encode($data);


} catch (PDOException $pdoex) {
    returnError($pdoex);
}