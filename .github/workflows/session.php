<?php 
session_start();
if (array_key_exists("id", $_COOKIE)) {
        
    $_SESSION['id'] = $_COOKIE['id'];
    
}

if (array_key_exists("id", $_SESSION)) {
    
    header("Location: diary.php");
    
} else {
    
    header("Location: index.php");
    
}
?>