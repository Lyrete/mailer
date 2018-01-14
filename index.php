<?php
ini_set('file_uploads', 'On');
?>

<form action="sent.php" method="post" enctype="multipart/form-data">
Sender: <input type="text" name="sender"><br>
Receiver: <input type="text" name="receiver"><br>
Subject: <input style="width:400px" type="text" name="subject"><br>
Attachment #1: <input type="file" name="fileToUpload1" id="fileToUpload1"><br>
Attachment #2: <input type="file" name="fileToUpload2" id="fileToUpload2"><br>

<br>

Text: <textarea name="text" rows="50" cols="200"></textarea><br>

<input type="submit">
