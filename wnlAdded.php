<?php

$text = $_POST["text"];

$finalText = '';

for ($i = 0; $i < strlen($text); $i++){
    
    if($text[$i] == "\n"){                                // Replaces newline chars with html breaks
        $finalText .= '<br>';                               
    } else {
        $finalText .= $text[$i];
    }
}

?>



<form action="wnlAdd.php" method="post">
    Added.<br>
<input type="submit" value="Back">

