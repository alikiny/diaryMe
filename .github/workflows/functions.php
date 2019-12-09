<?php
session_start();
//Change user personal info:
if(array_key_exists("proceed",$_POST)){
    $msg="";
    $error="";
    $update=0;
    $result=array();

    if($_POST['newName']){
        if(updateInfo('username',$_POST['newName'])==""){
            $update += 1;
            $msg.='<p>Updated username</p>';
           
        }else{
            $error.=updateInfo('username',$_POST['newName']);
        }
    }

    if($_POST['newEmail']){
        if(updateInfo('email',$_POST['newEmail'])==""){
            $update += 1;
            $msg.='<p>Updated email </p>';
           
        }else{
            $error.=updateInfo('email',$_POST['newEmail']);
        }
    }

    if($_POST['newPassword']){
       

        $password=md5(md5($_SESSION['id']) . $_POST['newPassword']);
        if(updateInfo('password',$password)==""){
            $update += 1;
            $msg.='<p>Updated password</p>';
           
        }else{
            $error.=updateInfo('password',$password);
        }
    }

    if($_POST['newAge']){
        if(updateInfo('age',$_POST['newAge'])==""){
            $update += 1;
            $msg.='<p>Updated age</p>';
           
        }else{
            $error.=updateInfo('age',$_POST['newAge']);
        }
    }

    if($_POST['newCountry']){
        if(updateInfo('country',$_POST['newCountry'])==""){
            $update += 1;
            $msg.='<p>Updated country</p>';
           
        }else{
            $error.=updateInfo('country',$_POST['newCountry']);
        }
    }

    if($_POST['newCity']){
        if(updateInfo('city',$_POST['newCity'])==""){
            $update += 1;
            $msg.='<p>Updated city</p>';
            
        }else{
            $error.=updateInfo('city',$_POST['newCity']);
        }
    }

    if($update===0){
        return null;

    }else{
        array_push($result,$msg);
        array_push($result,$_POST['newName']);
        array_push($result,$_POST['newEmail']);
        array_push($result,$_POST['newPassword']);
        array_push($result,$_POST['newAge']);
        array_push($result,$_POST['newCountry']);
        array_push($result,$_POST['newCity']);
    
        echo JSON_encode($result);
    }
  

}


function validateQuery($query){
    include('connect.php');
    if(mysqli_query($link,$query)){
        return mysqli_query($link,$query);
    }else{
        return mysqli_error($link);
    }
}

function fetchUserInfo(){
    include('connect.php');
    $query = "SELECT * FROM `users` WHERE
    userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'LIMIT 1";
    return validateQuery($query);

}

function searchTitles($title){
    include('connect.php');
    $query = "SELECT * FROM `diaries` WHERE 
    userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'
    AND title='" . mysqli_real_escape_string($link, $title) . "' ";

    $result= validateQuery($query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $foundEntry = $row['title'];
        if (file_exists($row['path'])) {
            $searchContent = file_get_contents($row['path']);
        }
        $msg='<p>Found you entry: ' . $foundEntry .
        ' in the entry list</p>'.'<p>File content: ' . $searchContent . '</p>';
    } else {
        $msg= "<div class='container m-5'>Title not found. You can view your entry list " . '<a href="#viewEntry" data-toggle="collapse" aria-expanded="true" aria-controls="viewEntry">here</a></div>';
    }

    return $msg;
}

function updateInfo($column,$value){
    include('connect.php');
    $query="UPDATE `users`
    SET $column = '".mysqli_real_escape_string($link,$value)."'
    WHERE userId='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
    if(!mysqli_query($link,$query)){
        return "Cannot updated column".$column." ".mysqli_error_list($link);
    }else{
        return "";
    }
}


?>