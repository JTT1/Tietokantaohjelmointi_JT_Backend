<?php
require_once "inc/functions.php";
require_once "inc/headers.php";

$input = json_decode(file_get_contents('PHP://input'));
$id = filter_var($input->id,FILTER_SANITIZE_NUMBER_INT);

try {

    $db = openDb();

    // $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = 'DELETE from tyontekija where tyontekijanro = :id';
    $query = $db->prepare($sql);
    $query->bindValue(":id",$id,PDO::PARAM_INT);
    $query->execute();

    header("HTTP/1.1 200 OK");

    $data = array("status" => "ok");
    echo json_encode($data);


} catch (PDOException $pdoex) {
    returnError($pdoex);
}