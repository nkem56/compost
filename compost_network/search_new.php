
<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include('data6rst.php');

if(isset($_POST['token']) && $_POST['token'] == '101201')
    {

$search = strip_tags($_POST['search_data_m']);
$result = $db->prepare('SELECT * FROM posts where address like :address limit 20');
$result->execute(array(
':address' => '%'.$search.'%'
));

$num_rec = $result->rowCount();
$row = $result->fetch();

if($num_rec == 0){

echo "<div id='alerts_search' class='alerts alert-danger searching_res_p1 search_hide'>Searched Data not Found... 
<span class='search_hide_btn1 btn btn-sm btn-warning pull-right'>close</span>
</div>";

}
elseif($num_rec > 0){



$id  = htmlentities(htmlentities($row['id']));
$pid = $id;
$title  = htmlentities(htmlentities($row['title']));
$title_seo  = htmlentities(htmlentities($row['title_seo']));
$address  = htmlentities(htmlentities($row['address']));
$photo  = htmlentities(htmlentities($row['userphoto']));


 echo "
<div class='searching_res_p search_hide'>
<a href='next1.html?title=$title_seo&pid=$pid&notifyId='>
<img class='img-circle' src='uploads/$photo' style='width:40px;height:40p; float:left; margin-right:6px' />
<span style='font-size:16px; color:white'>Title: $title</span><br>
<span style='font-size:16px; color:white'>Address: $address</span><br>
<span class='search_hide_btn1 btn btn-sm btn-warning pull-right'>close</span>
</a>
</div>";

}
else{

echo " <div style='background:red;padding:10px;color:white;'>There is problem with Queries</div>";
}



}


?>