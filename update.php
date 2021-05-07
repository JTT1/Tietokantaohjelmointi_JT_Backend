<?php
require_once "inc/functions.php";
require_once "inc/headers.php";

$input = json_decode(file_get_contents('PHP://input'));
$id = filter_var($input->id,FILTER_SANITIZE_NUMBER_INT);
$ttnimi = filter_var($input->ttnimi,FILTER_SANITIZE_STRING);
$ttsposti = filter_var($input->ttsposti,FILTER_SANITIZE_STRING);
$ttpuhnro = filter_var($input->ttpuhnro,FILTER_SANITIZE_STRING);
$ttosoite = filter_var($input->ttosoite,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $db->beginTransaction();

    $sql = 'UPDATE tyontekija SET nimi=:ttnimi, sposti=:ttsposti, puhnro=:ttpuhnro, osoite=:ttosoite where tyontekijanro=:id';

    $query = $db->prepare($sql);
    $query->bindValue(":id",$id,PDO::PARAM_INT);
    $query->bindValue(":ttnimi", $ttnimi,PDO::PARAM_STR);
    $query->bindValue(":ttsposti", $ttsposti,PDO::PARAM_STR);
    $query->bindValue(":ttpuhnro", $ttpuhnro,PDO::PARAM_STR);
    $query->bindValue(":ttosoite", $ttosoite,PDO::PARAM_STR);
    $query->execute();

    $db->commit();
    header("HTTP/1.1 200 OK");
    
    $data = array("status" => "ok");
    echo json_encode($data);



} catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}