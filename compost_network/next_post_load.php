




            <?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$title_seo = strip_tags($_POST['title']);
$postID_call = strip_tags($_POST['pid']);
$postid= $postID_call;


include('data6rst.php');



$result = $db->prepare('SELECT * FROM posts WHERE title_seo =:title_seo');
$result->execute(array(':title_seo' => $title_seo));
$db_count = $result->rowCount();

if($db_count ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Data has been Posted Yet.. <b></b></div>";
}


while ($row = $result->fetch()) {


                $id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
                $postid = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
                $title = htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
                $title_seo = htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));
                $content = htmlentities(htmlentities($row['content'], ENT_QUOTES, "UTF-8"));
                $timing = htmlentities(htmlentities($row['timing'], ENT_QUOTES, "UTF-8"));
                $username = htmlentities(htmlentities($row['username'], ENT_QUOTES, "UTF-8"));
                $userid = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
                $fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
                $photo = htmlentities(htmlentities($row['userphoto'], ENT_QUOTES, "UTF-8"));
                $post_type = 'post';
                $address = htmlentities(htmlentities($row['address'], ENT_QUOTES, "UTF-8"));
                $latitude = htmlentities(htmlentities($row['latitude'], ENT_QUOTES, "UTF-8"));
                $longitude = htmlentities(htmlentities($row['longitude'], ENT_QUOTES, "UTF-8"));

                $post_shortened =$content;
                $total_comments = htmlentities(htmlentities($row['total_comments'], ENT_QUOTES, "UTF-8"));





                

   // }





            ?>


<style>
.post_css1{
background:#ddd;
color:black;
border:none;
padding:10px;
border-radius:20%;
}


.post_css1:hover{
background:orange;
color:black;


}



.help_css{
background:#ddd;
color:black;
border:none;
padding:10px;
border-radius:20%;
font-size:20px;
}


.help_css:hover{
background:orange;
color:black;


}




</style>



        <script src="publish_post1.js" type="text/javascript"></script>


<div class='well'>



<div>

<?php
if($post_type){
?>
<img class='' style='border-style: solid; border-width:3px; border-color:#ec5574; width:80px;height:80px; 
max-width:80px;max-height:80px;border-radius: 50%;' src='uploads/<?php echo $photo; ?>'  title='User Image'><br>
<b style='color:#ec5574;font-size:18px;' >Name: <?php echo $fullname; ?> </b><br><br>

<?php } ?>

</div>


<div style='float:right;top:0px;right:0;margin-top:-150px;right:0px;'>

<button class='post_css1'>
<a title='Click to access users Profile page' style='color:black;' href='profile.html?id=<?php echo $userid; ?>'>
<span style='font-size:20px;color:#ec5574;' class='fa fa-user'></span> View Users Profile</a></button><br>

</div>




<?php
if($post_type == 'post'){
?>





<div class='help_css'>Composts Posts</div><br>


<button title='View Only this Composite Location on Map' class="map_css"><a target = "_blank" style="color:white;" href="map_private.html?identity=<?php echo $timing; ?>">
<i  style="color:white;font-size:30px;" class="fa fa-map-marker" aria-hidden="true"></i>
View Only this Composite Location on Map </a></button>&nbsp;&nbsp;

<button title='View All Composite Location on Map' class="map_css1"><a target = "_blank" style="color:white;" href="map.html">
<i  style="color:white;font-size:30px;" class="fa fa-map-marker" aria-hidden="true"></i>
View All Composite Location on Map</a></button><br><br>




<b class='title_css'>Title: <?php echo $title; ?></b><br><br>

<b >Descriptions:</b><br><?php echo $content; ?> ....<br>
<b>Location:</b> <?php echo $address; ?> &nbsp; &nbsp; &nbsp;

<?php } ?>



<br><br>
<span><b> <span style='color:#ec5574;' class='fa fa-calendar'></span>Time:</b>  <span data-livestamp="<?php echo $timing;?>"></span></span>



                        <div class="pc2">



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="font-size:26px;color:#ec5574;" class="fa fa-comments"></span> 
&nbsp;<span id="<?php echo $postid; ?>" style="cursor:pointer;" title="Comments" />Comments</span>
(<span id="comment_<?php echo $postid; ?>"><?php echo $total_comments; ?></span>)


<br>
</div>




                </div>

            <?php
            }
            ?>




<!--start comments -->





        <div class="content">




            <?php




$rowperpage = 5;
$post_field_c= 6;


$com = $db->prepare('SELECT * FROM comments WHERE postid =:postid');
$com->execute(array(':postid' => $postid));
$db_count_comm = $com->rowCount();
$total_count_c= $db_count_comm;
if($db_count_comm ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Comments has been Posted Yet.. <b></b></div>";
}


while ($row = $com->fetch()) {


                $id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));


// foreach($json_c['row'] as $v2){

                $id2 = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
                $comment_id = $id2;
                $postid2 = htmlentities(htmlentities($row['postid'], ENT_QUOTES, "UTF-8"));
                $comment2 = htmlentities(htmlentities($row['comment'], ENT_QUOTES, "UTF-8"));
                $timing2 = htmlentities(htmlentities($row['timing'], ENT_QUOTES, "UTF-8"));
                $userid2 = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
                $fullname2 = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
                $photo2 = htmlentities(htmlentities($row['photo'], ENT_QUOTES, "UTF-8"));
                

	
	

                

   // }





            ?>
                
                <div class="post alerts alert-warning comments_hovering" id="post_<?php echo $comment_id; ?>">


<style>

.comments_hovering:hover{
background: pink;
color:black;


}


.post_css1{
background:#ddd;
color:black;
border:none;
padding:10px;
border-radius:20%;
}


.post_css1:hover{
background:orange;
color:black;


}



.help_css{
background:#ddd;
color:black;
border:none;
padding:10px;
border-radius:20%;
font-size:20px;
}


.help_css:hover{
background:orange;
color:black;


}




</style>

<div>


<img class='' style='border-style: solid; border-width:3px; border-color:#ec5574; width:60px;height:60px; 
max-width:60px;max-height:60px;border-radius: 50%;' src='uploads/<?php echo $photo2; ?>' alt='User Image'><br>
<b style='color:#ec5574;font-size:18px;' >Name: <?php echo $fullname2; ?> </b><br><br>

</div>


<div style='float:right;top:0px;right:0;margin-top:-90px;right:0px;'>
<button class='post_css1'>
<a title='Click to access users Profile page' style='color:black;' href='profile.html?id=<?php echo $userid2; ?>'>
<span style='font-size:20px;color:#ec5574;' class='fa fa-user'></span> View Users Profile</a></button><br>

</div>






<b>Comments:</b> <?php echo $comment2; ?> &nbsp; &nbsp; &nbsp;

<br>
<span><b> <span style='color:;' class='fa fa-calendar'></span>Time:</b>  <span data-livestamp="<?php echo $timing2;?>"></span></span>






                </div><p></p>

            <?php
            }
            ?>

<!--START comment result form-->

<div id="commentsubmissionResult_<?php echo $postid; ?>"></div>

<!--end comment result form-->


            <h1 class="loadComment  category_post" title='Load More Comments!'> Load More Comments</h1>


<?php
if($total_count_c < 5 || $total_count_c == 5){
?>
(<span class="no_of_row_loaded"><?php echo $total_count_c; ?></span> out of <span class="p"><?php echo $total_count_c; ?></span>)
 <?php } ?>

<?php
if($total_count_c > 5){
?>
(<span class="no_of_row_loaded">5</span> out of <span class="p"><?php echo $total_count_c; ?></span>)
 <?php } ?>

            <input type="hidden" id="postRow" value="0">
            <input type="hidden" id="pCounter" value="<?php echo $total_count_c; ?>">

        </div>



<!--START comment form-->

<div id="commentsubmissionResult_<?php echo $postid; ?>"></div>


<div class="col-sm-12 form-group">
 <textarea  id="comdesc<?php echo $postID_call; ?>"  class="form-control" style="color:black;"  placeholder="Enter Comments"></textarea>
<div class='loader_comments'></div>

<br>
 <input data-color='' data-color1='' data-pe='ec' data-title='<?php echo $title; ?>' data-titleseo='<?php echo $title_seo; ?>' type="button" value="comment Now" id="<?php echo $postID_call; ?>" class="comment category_post2 pull-left" />


</div>
<br><br><p class='col-sm-12'></p>





<!--end comment form -->




<!--end comments -->






<?php


// update table notification_posts with Unread for read Updates starts

$notifyId = intval($_POST['notifyId']);

if($notifyId != ''){

include('data6rst.php');
$update= $db->prepare('UPDATE notification_posts set status =:status where id =:id');

$update->execute(array( 
':id' => $notifyId,
':status' => 'read' 
));


}

?>



