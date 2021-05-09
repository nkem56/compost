<?php 
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 // ensure that there is no whitespace and included file quickbase_token.php does not have whitespace
header("Content-type: text/xml");
include('data6rst1.php');
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
$identity = strip_tags($_GET['identity']);
$result = $db->prepare("SELECT * FROM posts where timing=:timing");
$result->execute(array(':timing' =>$identity));
//header("Content-type: text/xml");
while ($v1 = $result->fetch()) {
                $id = $v1['id'];
                $postid = $v1['id'];
                $title = $v1['title'];
                $title_seo = $v1['title_seo'];
                $content = $v1['content'];
                $timing = $v1['timing'];
                $userid = $v1['userid'];
                $fullname = $v1['fullname'];
                $photo = $v1['userphoto'];
                $address = $v1['address'];
                $lat = $v1['latitude'];
                $lng = $v1['longitude'];
                $data ='public';
                $type = 1;
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id",$id);
  $newnode->setAttribute("name",$fullname);
  $newnode->setAttribute("photo",$photo);
  $newnode->setAttribute("address", $address);
  $newnode->setAttribute("lat", $lat);
  $newnode->setAttribute("lng", $lng);
  $newnode->setAttribute("type", $type);
  $newnode->setAttribute("data_type", $data);
$newnode->setAttribute("fullname", $fullname);
$newnode->setAttribute("userid", $userid);
$newnode->setAttribute("timing", $timing);
}
echo $dom->saveXML();
?>