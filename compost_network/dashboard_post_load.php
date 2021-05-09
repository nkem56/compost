

<?php
//error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


?>
        <script src="publish_post1.js" type="text/javascript"></script>
       
       <script>



$(document).ready(function(){


    $('.loadPost').click(function(){
        var postRow = Number($('#postRow').val());
        var postCount = Number($('#pCounter').val());
        postRow = postRow + 5;

        if(postRow <= postCount){
            $("#postRow").val(postRow);

            $.ajax({
                url: 'post_loadmoreData.php',
                type: 'post',
                data: {postRow:postRow},
                beforeSend:function(){
                    //$(".loadPost").text("Loading Data...");
$(".loadPost").html("<span class='loader_post'></span> Loading Data...");
                    $('.loader_post').fadeIn(400).html('<span><i class="fa fa-spinner fa-spin" style="font-size:20px"></i></span>');

                },
                success: function(response){
                    setTimeout(function() {
                        $(".post:last").after(response).show().fadeIn("slow");
 
                        var rowno = postRow + 5;

//check number of row loaded
if(rowno > postCount){

var pRow = Number($('#postRow').val());
var pCount = Number($('#pCounter').val());

var remaining_row = pCount - pRow;

var pRow1 = pRow + remaining_row;
$(".no_of_row_loaded").text(pRow1);

}else{

$(".no_of_row_loaded").text(rowno);
}

                   
                        if(rowno > postCount){
                            $('.loadPost').text("No More Content to Load");
                              $('.loader_post').hide();
                        }else{
                            $(".loadPost").text("Load more");
                           $('.loader_post').hide();
                        }
                    }, 2000);
                   


                }
            });
        }

    });

});




$(document).ready(function(){
var userid_sess_data = localStorage.getItem('useridsessdata');
var fullname_sess_data = localStorage.getItem('fullnamesessdata');
var photo_sess_data = localStorage.getItem('photosessdata');
$('#myd_userid_sess_value').val(userid_sess_data).value;
$('#myd_userid_sess_id').html(userid_sess_data);

$('#myd_fullname_sess_value').val(fullname_sess_data).value;
$('#myd_photo_sess_value').val(photo_sess_data).value;
});



</script>




<style>
.point_count { color: #FFF; display: block; float: right; border-radius: 12px; border: 1px solid #2E8E12; background: #ec5574; padding: 2px 6px;font-size:20px; }
.point_count1 { color:#FFF; display: block; float: right; border-radius: 12px; border: 1px solid #2E8E12; background: purple; padding: 2px 6px;font-size:20px; }


</style>






<!--start loading post-->



<!--input type='text' id='myd_userid_sess_value' class='userid_send1' value='' -->
<!--input type='text' id='myd_fullname_sess_value' class='fullname_send1' value=''-->
<!--input type='text' id='myd_photo_sess_value' class='photo_send1' value=''-->

<div style='display:none;' id='myd_userid_sess_id' data-useridsend2='myd_userid_sess_id'></div>


        <div class="content">





            <?php

$rowperpage = 5;

include('data6rst.php');

$row=0;
//counting total number of posts

$status_result = $db->prepare("SELECT count(*) as allcount FROM posts");
$status_result->execute(array());
$status_row = $status_result->fetch();
$total_count = $status_row['allcount'];




// select first 3 posts

$result = $db->prepare("SELECT * FROM posts order by id desc limit :row1, :rowpage");
//$result->bindValue(':course_id', (int) trim($course_id), PDO::PARAM_INT);
//$result->bindValue(':token', PDO::PARAM_STRING);

$result->bindValue(':rowpage', (int) trim($rowperpage), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($row), PDO::PARAM_INT);


$result->execute();

$count_post = $result->rowCount();
if($count_post ==0){
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

                $post_shortened = substr($content, 0, 90)."...";
$total_comments = htmlentities(htmlentities($row['total_comments'], ENT_QUOTES, "UTF-8"));

	





            ?>
                
                <div class="post well" id="post_<?php echo $postid; ?>">


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

<div>

<?php
if($post_type){
?>
<img class='' style='border-style: solid; border-width:3px; border-color:#ec5574; width:80px;height:80px; 
max-width:80px;max-height:80px;border-radius: 50%;' src='uploads/<?php echo $photo; ?>' title='Image'><br>
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

<button title='View Only this Composts Locations on Map' class="map_css"><a target = "_blank" style="color:white;" href="map_private.html?identity=<?php echo $timing; ?>">
<i  style="color:white;font-size:30px;" class="fa fa-map-marker" aria-hidden="true"></i>
View Only this Composts Locations on Map </a></button>&nbsp;&nbsp;

<button title='View All Composts Locations on Map' class="map_css1"><a target = "_blank" style="color:white;" href="map.html">
<i  style="color:white;font-size:30px;" class="fa fa-map-marker" aria-hidden="true"></i>
View All Composts Locations on Map</a></button><br><br>




<b class='title_css'>Title:<?php echo $title; ?></b><br><br>


<b >Descriptions:</b><br><?php echo $post_shortened; ?> ....<br>
<b>Location:</b> <?php echo $address; ?> &nbsp; &nbsp; &nbsp;

<?php } ?>



<br><br>
<span><b> <span style='color:#ec5574;' class='fa fa-calendar'></span>Time:</b>  <span data-livestamp="<?php echo $timing;?>"></span></span>



                        <div class="pc2">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="font-size:26px;color:#ec5574;" class="fa fa-comments"></span> 
&nbsp;<span id="<?php echo $postid; ?>" style="cursor:pointer;" title="Comments" /><a title='Comments' style='color:black' href='next1.html?title=<?php echo $title_seo; ?>&pid=<?php echo $postid; ?>&uid=<?php echo $userid; ?>&tit=<?php echo $title; ?>'>Comments</a></span>
(<span id="comment_<?php echo $postid; ?>"><?php echo $total_comments; ?></span>)


<br>
<br>
<button class='readmore_btn btn btn-warning'><a title='Click to Read More and Comments' style='color:white;' 
href='next1.html?title=<?php echo $title_seo; ?>&pid=<?php echo $postid; ?>&notifyId='>Click to Read-More & Comments</a></button>
</div>




                </div>

            <?php
            }
            ?>

            <h1 class="loadPost  category_post" title='Load More Post!'> Load More Posts</h1>


<?php
if($total_count < 5 || $total_count == 5){
?>
(<span class="no_of_row_loaded"><?php echo $total_count; ?></span> out of <span class="p"><?php echo $total_count; ?></span>)
 <?php } ?>

<?php
if($total_count > 5){
?>
(<span class="no_of_row_loaded">5</span> out of <span class="p"><?php echo $total_count; ?></span>)
 <?php } ?>

            <input type="hidden" id="postRow" value="0">
            <input type="hidden" id="pCounter" value="<?php echo $total_count; ?>">

        </div>




<!--End loading posts-->
