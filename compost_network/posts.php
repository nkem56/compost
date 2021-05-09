<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



//include('cors.php');
//include('time_limit.php');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");

$title = strip_tags($_POST['title']);
//replace any space with hyphen
$sp ='-';
$tt = time();
$title_seo = str_replace(' ', '-', $title.$sp.$tt);






$geo_address = trim($_POST['geo_address']);
$offering = strip_tags($_POST['offering']);
$messaging = strip_tags($_POST['messaging']);

//$messaging =  htmlentities(htmlentities($_POST['messaging']));
$help_category = strip_tags($_POST['help_category']);


$userid_sess_data = $_POST['userid_sess_data'];
$fullname_sess_data = $_POST['fullname_sess_data'];
$photo_sess_data = $_POST['photo_sess_data'];
$session_points_data = $_POST['points_sess_data'];


$address = urlencode($geo_address);
// geocode geo location address to longitudes and latitudes

$call_url ="https://maps.googleapis.com/maps/api/geocode/json?key=YOUR-GOOGLE-API-KEY-GOES-HERE&address=$address&sensor=false";
 $res = file_get_contents($call_url);
 $json = json_decode($res, true);
//print_r($json);

        if($json['status']='OK'){

         $lat = $json['results'][0]['geometry']['location']['lat'];
         $lng = $json['results'][0]['geometry']['location']['lng'];
         $formatted_address = $json['results'][0]['formatted_address'];

}else{
echo 22;
exit();
}

         $lat = $json['results'][0]['geometry']['location']['lat'];
         $lng = $json['results'][0]['geometry']['location']['lng'];




include('data6rst.php');


$statement = $db->prepare('INSERT INTO posts
(title,title_seo,content,timing,username,fullname,userphoto,photo,userid,address,latitude,longitude,total_comments)
                        values
(:title,:title_seo,:content,:timing,:username,:fullname,:userphoto,:photo,:userid,:address,:latitude,:longitude,:total_comments)');
$statement->execute(array( 

':title' => $title,
':title_seo' => $title_seo,
':content' => $messaging,
':timing' => $timer,
':username' => $username_sess_data,
':fullname' => $fullname_sess_data,
':userphoto' => $photo_sess_data,
':photo' => '0',
':userid' => $userid_sess_data,
':address' => $geo_address,
':latitude' => $lat,
':longitude' => $lng,
':total_comments' => '0'
));


$res = $db->query("SELECT LAST_INSERT_ID()");
$lastId_post = $res->fetchColumn();



// send post broadcast notifications to all community members


// query users table to update notification_post table
$result = $db->prepare('SELECT * FROM users where id != :id');
$result->execute(array(':id' => $userid_sess_data));
$nosofrows = $result->rowCount();




if($nosofrows > 0){
//foreach($row['data'] as $v1){
while($row = $result->fetch()){

$reciever_userid = $row['id'];
$reciever_username = $v1['username'];
		    
//insert into notification_post table
//insert starts




$statement1 = $db->prepare('INSERT INTO notification_posts
(post_id,userid,fullname,photo,user_rank,reciever_id,status,type,timing,title,title_seo)
                        values
(:post_id,:userid,:fullname,:photo,:user_rank,:reciever_id,:status,:type,:timing,:title,:title_seo)');
$statement1->execute(array( 

':post_id' => $lastId_post,
':userid' => $userid_sess_data,
':fullname' => $fullname_sess_data,
':photo' => $photo_sess_data,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'post',
':timing' => $timer,
':title' => $title,
':title_seo' => $title_seo
));







//insert ends
		  

		    //$count++;
		}
	}else{
		//echo "<div>No Users found.</div>";
	}
	




if($statement){
echo 1;	

}
else{
//echo "post could not be submitted";
echo 2;
}






?>