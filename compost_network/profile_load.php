
<?php 
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);



include('data6rst.php');
$request_userid= intval($_POST['r_id']);

// query users table
$result = $db->prepare('SELECT * FROM users where id =:id');
$result->execute(array(':id' => $request_userid));
$nosofrows = $result->rowCount();
$row = $result->fetch();



$user_rec_count = $nosofrows;
$u_rec_id = $row["id"];
$fullname = $row["fullname"];
$photo =    $row["photo"];
$user_rank = $row["user_rank"];
$created_time = $json3["timing"];



if($user_rec_count == 0){
echo "<div style='background:red;color:white;padding:10px;'>No Record Found for the Queried User..</div>";
exit();
}




// query posts table
$result1 = $db->prepare('SELECT * FROM posts where userid =:userid');
$result1->execute(array(':userid' => $request_userid));
$nosofrows1 = $result1->rowCount();
$row1 = $result1->fetch();


?>




<!--create profile form START here-->

<div  class='col-sm-12' style='border-style: dashed; border-width:2px; border-color: orange;color:black;padding:10px;background:#eeeeee'>

<h3><center>Members Profiles/Posts</center></h3>
<div class='col-sm-6'>
<img style='max-height:200px;max-width:200px;' class='img-rounded' width='200px' height='200px' src='uploads/<?php echo $photo; ?>'>
<br>
</div>
<div class='col-sm-6'>
<b> Name:</b> <?php echo htmlentities(htmlentities($fullname, ENT_QUOTES, "UTF-8")); ?>
<br>
<b style='font-size:16px;'> Rank:</b> <?php echo htmlentities(htmlentities($user_rank, ENT_QUOTES, "UTF-8")); ?><br>
<b style='font-size:16px;'> Status:</b> Verified Member<br>
<b style='font-size:20px;color:#ec5574'> This Member has : <?php echo $nosofrows1; ?> Posts</b><br>


<b style='font-size:16px;'> Member Since:</b> <span data-livestamp='<?php echo $created_time; ?>'></span><br>
<div style='background:#ec5574;color:white;padding:10px;border-radius:20%;font-size:16px;'><i  style='font-size:20px;' class='fa fa-check'></i> User Verified</div>
</div>



<div  class='col-sm-12' style='width:100%;'><br><br></div>






<!--create profile form ENDS-->
