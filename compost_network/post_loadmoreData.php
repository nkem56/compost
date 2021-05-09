
        <script src="publish_post1.js" type="text/javascript"></script>


<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 include('header_title.php');

$row  = $_POST['postRow'];
$rowperpage = 5;
//include quickbase token
include('data6rst.php');



$result = $db->prepare("SELECT * FROM posts order by id desc limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($rowperpage), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($row), PDO::PARAM_INT);
$result->execute();

$output_post = '';

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


 //foreach($row['data'] as $v1){
 


    $output .= '<div id="post_'.$id.'" class="post well">';
if($post_type == 'post' ){

$output .= "<div class=''>
<img class='' style='border-style: solid; border-width:3px; border-color:#ec5574; width:80px;height:80px; 
max-width:80px;max-height:80px;border-radius: 50%;' src='uploads/$photo' title='Image'><br>
<b style='color:#ec5574;font-size:18px;' >Name: $fullname </b><br><br>
</div>";

}



$output .= "<div style='float:right;top:0px;right:0;margin-top:-150px;right:0px;'>
<span class='point_count'><span>Scores: </span> $points Points</span>
<button class='post_css1'>
<a title='Click to access users Profile page' style='color:black;' href='profile.html?id=$userid'>
<span style='font-size:20px;color:#ec5574;' class='fa fa-user'></span> View Users Profile</a></button><br>
                     
</div>";




$output .= "<div class='help_css'>Composts Posts</div><br>";

$output .= "
<button title='View Only this Composts Locations on Map' class='map_css'>
<a target = '_blank' style='color:white;' href='map_private.html?identity=$timing'>
<i  style='color:white;font-size:30px;' class='fa fa-map-marker' aria-hidden='true'></i>
View Only this Composts Locations on Map </a></button>&nbsp;&nbsp;

<button title='View All Composts Locations on Map' class='map_css1'><a target = '_blank' style='color:white;' href='map.html'>
<i  style='color:white;font-size:30px;' class='fa fa-map-marker' aria-hidden='true'></i>
View All Composts Locations on Map</a></button><br><br>";




 


$output .= "<b class='title_css'>Title: $title</b><br><br>";

$output .= "<b >Descriptions:</b><br> $post_shortened ....<br>
<b>Location:</b> $address &nbsp; &nbsp; &nbsp;
<br>";

 






$output .= "<br>
<span><b> <span style='color:#ec5574;' class='fa fa-calendar'></span>Time:</b>  
<span data-livestamp='$timing'></span></span>";


                        $output .= "<div class='pc2'>



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style='font-size:26px;color:#ec5574;' class='fa fa-comments'></span> 
&nbsp;<span id='$postid' style='cursor:pointer;' title='Comments' />
<a title='Comments' style='color:black' href='next1.html?title=$title_seo&pid=$postid&uid=$userid&tit=$title'>Comments</a></span>
(<span id='comment_$postid'>$total_comments</span>)


<br>
<br>
<button class='readmore_btn btn btn-warning'><a title='Click to Read More and Comments' style='color:white;' 
href='next1.html?title=$title_seo&pid=$postid'>Click to Read-More & Comments</a></button>
</div>";





  
    $output .= '</div>';

}

echo $output;
