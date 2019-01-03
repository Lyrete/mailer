<?php
include_once "userPDO.php";
session_start();

if($_SESSION["user"] != NULL){

    include 'navigation.php';
    $db = new DB();
    $user = $_SESSION['user'];

$userPDO = new UserPDO();

?>
<a href="merin_Testamentti_newpw.pdf"><img src="pdfIcon.png" height="20px"> Merin vanha testamentti uusilla salasanoilla.</a><br><br>
<?php
echo "under construction.";
}else{
    include 'index.php';
};
?>
