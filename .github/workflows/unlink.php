<?php
session_start();
$filepath = $_GET['filepath'];
if (!unlink($filepath)) {

    $msg = "Error deleting" . $filepath;
} else {

    include("connect.php");
    $query = "DELETE FROM `diaries` WHERE `path` = '" . mysqli_real_escape_string($link, $filepath) . "'";
    if (mysqli_query($link, $query)) {
        $msg = "File is deleted";
    } else {
        $msg = "Error deleting: " . mysqli_error($link);
    }
} 
echo $msg;

echo '
<script type="text/javascript">
    //Save the value of msg to the sessionStorage, so we can display it 
    //in the other pages
    

    if (typeof(Storage) !== "undefined") {
        // Store the value of $msg to sessionStorage
        sessionStorage.setItem("unlink", `<? echo $msg; ?>`);

        sessionStorage.setItem("index","viewEntry");
        
    }else{
        sessionStorage.setItem("unlink", `Browser does not support this message`);
    }
</script>
';

header("Location: diary.php");


?>




