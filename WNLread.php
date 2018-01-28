<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'database.php';

$db = new DB();

?>

<center>
<?php include $db->getPublishedLetterURL(5);?>
</center>
