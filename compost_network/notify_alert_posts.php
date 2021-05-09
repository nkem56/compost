<?php

error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('data6rst.php');

$userid_sess_data = $_POST['userid_sess_data'];
require('data6rst.php');

$result = $db->prepare('SELECT * FROM notification_posts where reciever_id = :reciever_id');

		$result->execute(array(
			':reciever_id' => $userid_sess_data
    ));
$nosofrows = $result->rowCount();
echo $nosofrows;




?>

