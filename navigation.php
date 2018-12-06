<?php
require_once 'database.php';
require_once 'userPDO.php';
require_once 'user.php';

$user = $_SESSION["user"]

?>

<style><?php include 'styles.css'; ?></style>

<head>
    <title>Newsletter CP</title>
</head>

Logged in as <?php echo "<br>" . $user->getName() . " <br>" . $user->getEmail()?><br><br>

<div class="links">
    <a href ="wnlAdd.php"><div class="pagePart">Add events</div></a>
    <a href ="eventManager.php"><div class="pagePart">Manage events</div></a>
<!--    <a href="TGmsg.php"><div class="pagePart">Send a TG message</div></a>-->
<?php if($user->getUsr_lvl() == "admin"){?>
    <a href="addUser.php"><div class="pagePart">User management</div></a>
<?php }?>
    <a href="addHeader.php"><div class="pagePart">Header insertion</div></a>
    <a href ="finalMail.php"><div class="pagePart">Construct the newsletter</div></a>
</div>
