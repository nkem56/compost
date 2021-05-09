<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


include('data6rst.php');


$postid = strip_tags($_POST['postid']);
$comment_type = strip_tags($_POST['type']);
$type = strip_tags($_POST['type']);
$comdesc = strip_tags($_POST['comdesc']);

$userid_sess_data = $_POST['userid_sess_data'];
$fullname_sess_data = $_POST['fullname_sess_data'];
$photo_sess_data = $_POST['photo_sess_data'];

if ($comdesc == ''){
exit();
}

$timer=time();




// insert into comments table
$statement = $db->prepare('INSERT INTO comments
(postid,comment,timing,userid,fullname,photo)
 
                          values
(:postid,:comment,:timing,:userid,:fullname,:photo)');

$statement->execute(array( 
':postid' => $postid,
':comment' => $comdesc,
':timing' => $timer,
':userid' => $userid_sess_data,
':fullname' => $fullname_sess_data,
':photo' => $photo_sess_data
));


$res = $db->query("SELECT LAST_INSERT_ID()");
$commentID = $res->fetchColumn();


// query table posts to get data
$result = $db->prepare('SELECT * FROM posts WHERE id =:id');
$result->execute(array(':id' => $postid));
$db_count = $result->rowCount();

if($db_count ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>This Post does not exist Yet.. <b></b></div>";
}
$row = $result->fetch();

$post_userid= htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$reciever_userid = $post_userid;
$title= htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$title_seo= htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));
$t_comments= htmlentities(htmlentities($row['total_comments'], ENT_QUOTES, "UTF-8"));;
$totalcomment = $t_comments + 1;


               


// insert into notification post table



$statement2 = $db->prepare('INSERT INTO notification_posts
(post_id,userid,fullname,photo,user_rank,reciever_id,status,type,timing,title,title_seo)
                        values
(:post_id,:userid,:fullname,:photo,:user_rank,:reciever_id,:status,:type,:timing,:title,:title_seo)');
$statement2->execute(array( 

':post_id' => $postid,
':userid' => $userid_sess_data,
':fullname' => $fullname_sess_data,
':photo' => $photo_sess_data,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'comment',
':timing' => $timer,
':title' => $title,
':title_seo' => $title_seo
));


// update table posts to reflect comments counts


$update= $db->prepare('UPDATE posts set total_comments =:total_comments where id =:id');

$update->execute(array( 
':id' => $postid,
':total_comments' => $totalcomment 
));


$array_comment = array("comment"=>$totalcomment,"comdesc"=>$comdesc,"comment_username"=>$username_sess_data,"comment_fullname"=>$fullname_sess_data,"comment_photo"=>$photo_sess_data,"comment_time"=>$timer, "userid"=>$userid_sess_data, "comment_id"=>$commentID);
echo json_encode($array_comment);

?>