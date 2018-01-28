<?php

session_start();

?>


<form action="finalMail.php" method="post" enctype="multipart/form-data">
    Sender: <input type="text" name="sender"><br>
    Receiver: <input type="text" name="receiver"><br>
    Subject: <input style="width:400px" type="text" name="subject"><br>
    When to send: <input type="time" name="timeToSend" id="timeToSend"><br>

    <br>

    Footer: <textarea name="footer" rows="25" cols="200"></textarea><br>
    
    
    <input type="submit">
</form>

<?php

if(isset($_POST["sender"])==TRUE){
    
    include 'construct.php';
    
    include 'mailit.php';
}


