<?php

$db = new mysqli("localhost", "root", "", "myvoqu_fixed");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;

// var_dump($message);die();

if (!empty($message) && !empty($from)) {

    $sql = "INSERT INTO `chatall` (`message`, `from`, `id_user`) VALUES ('" . $message . "','" . $from . "','" . $id_user . "')";
    $result['send_status'] = $db->query($sql);
}

//print message
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $db->query("SELECT * FROM `chatall` WHERE `id` > " . $start);
while ($row = $items->fetch_assoc()) {
    $result['items'][] = $row;
}

$db->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);