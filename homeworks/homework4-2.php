<?php
if(isset($_GET["username"])){
    echo "You're username is". $_GET["username"];
}
if(isset($_POST["password"])){
    echo "You're password is". $_POST["password"];
}

?>