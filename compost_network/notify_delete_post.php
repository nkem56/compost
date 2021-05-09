<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include('data6rst.php');



$id=strip_tags($_POST['id']);
$reciever_id=strip_tags($_POST['rid']);



$del = $db->prepare('DELETE from notification_posts where id=:id');
$del->execute(array(':id' => $id));



if($del){

echo 1;
}else{

echo 0;
}









?>


