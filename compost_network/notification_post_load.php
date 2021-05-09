<?php 
ob_start();
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('header_title.php');


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);

 ?>
<script>
$(document).ready(function(){

$('.notify_delete_post_btn').click(function(){
// confirm start
 if(confirm("Are you sure you want to Delete This Posts Alerts: ")){
var id = $(this).data('id');
var rid = $(this).data('rid');

//var userid_sess_data = localStorage.getItem('useridsessdata');

$(".loader-notify-delete-post_"+id).fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait, Posts Alerts is being deleted...</div>');
var datasend = {'id': id, 'rid': rid};
		$.ajax({
			
			type:'POST',
			url:'notify_delete_post.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


	if(msg == 1){
alert('Posts Alerts Successfully Deleted');
$(".loader-notify-delete-post_"+id).hide();
$(".result-notify-delete-post_"+id).html("<div style='color:white;background:green;padding:10px;'>Posts Alerts Successfully Deleted</div>");
setTimeout(function(){ $(".result-notify-delete-post_"+id).html(''); }, 5000);
location.reload();
}


	if(msg == 0){

alert('Posts Alerts could not be deleted. Please ensure you are connected to Internet.');
$(".loader-notify-delete-post_"+id).hide();
$(".result-notify-delete-post_"+id).html("<div style='color:white;background:red;padding:10px;'>Posts Alerts could not be deleted. Please ensure you are connected to Internet.</div>");
setTimeout(function(){ $(".result-notify-delete-post_"+id).html(''); }, 5000);

}

}
			
});
}

// confirm ends

                });










            });






</script>





<style>



.post-css2{
background:#ec5574;
border:none;
color:white;
padding:6px;
border-radius:20%;
}

.post-css2:hover{
background:orange;
color:black;
}




.post-css1{
background:red;
border:none;
color:white;
padding:6px;
}

.post-css1:hover{
background:orange;
color:black;
}


.post-css{
background:navy;
border:none;
color:white;
padding:6px;
text-align:center;
}

.post-css:hover{
background:orange;
color:black;
}

.notify_content_css{
display:inline-block;border-style: dashed; border-width:2px; border-color: 
orange;color:black;background:#eeeeee;padding:10px;
}


.notify_content_css:hover{
color:black;background:#ec5574;
}
</style>




<?php


//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$sender_id=strip_tags($_POST['sender_id']);
$userid_sess_data = $sender_id;


require('data6rst.php');

$result = $db->prepare('SELECT * FROM notification_posts where reciever_id = :reciever_id order by id desc');

		$result->execute(array(
			':reciever_id' => $userid_sess_data
    ));
$nosofrows = $result->rowCount();
//echo $nosofrows;

$rec_List1 = $nosofrows;


if($rec_List1  == 0){

echo "<div style='background:red;color:white;padding:10px;border:none'>No New Post or Comments Alerts Yet.</div>";
}


while($v1 = $result->fetch()){
//foreach($row['data'] as $v1){


$id = $v1['id'];
$post_id = $v1['post_id'];
$sender_userid = $v1['userid'];
$sender_fullname1 = $v1['fullname'];
$sender_photo = $v1['photo'];
$department =  $v1['user_rank'];
$rid = $v1['reciever_id'];
$status = $v1['status'];
$type  = $v1['type'];
$timing = $v1['timing'];
$title = $v1['title'];
$microtitle = substr($title, 0, 80)."...";
$title1 = $v1['title_seo'];


// replace empty space with hyphen
$sender_fullname = str_replace(' ', '-', $sender_fullname1);



?>





<div class="col-sm-12 notify_content_css" >
<?php 
if($type == 'post'){
?>


<div  style="color:black;padding:10px;background:#ddd">
<a href='profile.html?id=<?php echo $sender_userid; ?>' class='pull-right post-css2' title='View Profile'>Profile</a>

<img style='max-height:60px;max-width:60px;' class='img-circle' src='uploads/<?php echo $sender_photo; ?>' alt='User Image'>


<span style='font-size:20px;color:navy;' class="fa fa-edit"></span><b style='color:navy'>Post <?php echo $status;?></b>

<br><b><?php echo $sender_fullname1; ?>(<?php echo $department;?>)</b> Just published a New Posts<br>
<b>Title:</b> <?php echo $microtitle; ?><br>
<span style='color:#800000;'><b> Time: </b> <span data-livestamp="<?php echo $timing;?>"></span></span> 

<?php 
if($status == 'unread'){
?>
<span style='font-size:20px;color:green;' class="fa fa-check"></span>
<?php } ?>


<?php 
if($status == 'read'){
?>
<span style='font-size:20px;color:green;' class="fa fa-check"></span><span style='font-size:20px;color:green;' class="fa fa-check"></span>
<?php } ?>

<br>

<p>
<a href='next1.html?title=<?php echo $title1; ?>&notifyId=<?php echo $id; ?>&rID=<?php echo $rid; ?>&pid=<?php echo $post_id; ?>' class='pull-left col-sm-5 post-css' title='View Posts'>View Posts</a>
<button class='pull-right col-sm-6 post-css1 notify_delete_post_btn' data-id='<?php echo $id; ?>' data-rid='<?php echo $rid; ?>' title='Delete Alerts'>Delete Alerts</button>
   <div class="loader-notify-delete-post_<?php echo $id; ?>"></div>
   <div class="result-notify-delete-post_<?php echo $id; ?>"></div>
</p>
<br>
</div>
<?php
}
?>










<?php 
if($type == 'comment'){
?>


<div  style="color:black;padding:10px;background:#ddd">
<a href='profile.html?id=<?php echo $sender_userid; ?>' class='pull-right post-css2' title='View Profile'>Profile</a>

<img style='max-height:60px;max-width:60px;' class='img-circle' src='uploads/<?php echo $sender_photo; ?>' alt='User Image'>


<span style='font-size:20px;color:navy;' class="fa fa-comments-o"></span><b style='color:navy'>Comment <?php echo $status;?></b>

<br><b><?php echo $sender_fullname1; ?>(<?php echo $department; ?>)</b> Commented on your Posts<br>
<b>Title:</b> <?php echo $microtitle; ?><br>
<span style='color:#800000;'><b> Time: </b> <span data-livestamp="<?php echo $timing;?>"></span></span> 

<?php 
if($status == 'unread'){
?>
<span style='font-size:20px;color:green;' class="fa fa-check"></span>
<?php } ?>


<?php 
if($status == 'read'){
?>
<span style='font-size:20px;color:green;' class="fa fa-check"></span><span style='font-size:20px;color:green;' class="fa fa-check"></span>
<?php } ?>

<br>

<p>
<a href='next1.html?title=<?php echo $title1; ?>&notifyId=<?php echo $id; ?>&rID=<?php echo $rid; ?>&pid=<?php echo $post_id; ?>' class='pull-left col-sm-5 post-css' title='View Posts'>View Posts</a>
<button class='pull-right col-sm-6 post-css1 notify_delete_post_btn' data-id='<?php echo $id; ?>' data-rid='<?php echo $rid; ?>' title='Delete Alerts'>Delete Alerts</button>
   <div class="loader-notify-delete-post_<?php echo $id; ?>"></div>
   <div class="result-notify-delete-post_<?php echo $id; ?>"></div>
</p>
<br>
</div>
<?php
}
?>

















</div>



<?php
}
?>

<?php
ob_flush();
?>


