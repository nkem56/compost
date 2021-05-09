<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);


if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Email is empty</font></div>";
exit();
}


if ($password == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>password is empty</font></div>";
exit();
}


// honey pot spambots
$emailaddress_pot =$_POST['emailaddress_pot'];
if($emailaddress_pot !=''){
//spamboot detected.
//Redirect the user to google site

echo "<script>
window.setTimeout(function() {
    window.location.href = 'https://google.com';
}, 1000);
</script><br><br>";

exit();
}



include('data6rst.php');



$result = $db->prepare('SELECT * FROM users where email = :email');

		$result->execute(array(
			':email' => $email

    ));

$count = $result->rowCount();

$row = $result->fetch();

if( $count == 1 ) {





//start hashed passwordless Security verify
if(password_verify($password,$row["password"])){
            //echo "Password verified and ok";


$userid = htmlentities(htmlentities($row["id"]));
$fullname = htmlentities(htmlentities($row["fullname"]));
$username = htmlentities(htmlentities($row["username"]));
$email = htmlentities(htmlentities($row["email"]));
$photo = htmlentities(htmlentities($row["photo"]));
$user_rank = htmlentities(htmlentities($row["user_rank"]));


// initialize session if things where ok via html5 local storage.
echo "<script>


localStorage.setItem('useridsessdata', '$userid');
localStorage.setItem('fullnamesessdata', '$fullname');
localStorage.setItem('usernamesessdata', '$username');
localStorage.setItem('emailsessdata', '$email');
localStorage.setItem('photosessdata', '$photo');

localStorage.setItem('titleheader', 'Compost Network');
localStorage.setItem('titlefooter', 'Building Compost Share Communities');
localStorage.setItem('appcolor', '#ec5574');



//var vv = localStorage.getItem('levelssessdata');
//alert(vv);


</script>";


echo "<div class='alert alert-success'>Login sucessful <img src='ajax-loader.gif'></div>";
echo "<script>window.location='dashboard_welcome.html'</script>";



}
else{
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Password Does not Matched</font></div>";

}



}
else {
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>User with This Email does not exist..</font></div>";
}






?>

<?php ob_end_flush(); ?>
