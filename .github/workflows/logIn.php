<?php

session_start();
if($_SESSION['id']){
    header("Location: diary.php");
}else{
    include("header.php");




if (array_key_exists("submit", $_POST)) {
    echo "Start sign up";
    $error = "";
    if (!$_POST['username']) {

        $error .= "User name is required<br>";
    }

    if (!$_POST['password']) {

        $error .= "Password is required<br>";
    }

    if ($error != "") {

        $error = "<p>There were error(s) in your form:</p>" . $error;
    } else {


        include("connect.php");
        $query = "SELECT * FROM `users` WHERE username = '" . mysqli_real_escape_string($link, $_POST['username']) . "'";

        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_array($result);
        if (isset($row)) {
            
            $hashedPassword = md5(md5($row['userId']) . $_POST['password']);

            if ($hashedPassword == $row['password']) {

                $_SESSION['id'] = $row['userId'];

                if ($_POST['stayLoggedIn'] == '1') {

                    setcookie("id", $row['userId'], time() + 60 * 60 * 24 * 365);
                }

                header("Location: session.php");
            } else {

                $error = "That email/password combination could not be found.";
            }
        }
    }
    echo $error;
}


}



?>




    <div class="container-fluid">
        <h1 class="text-center m-5">Log In </h1>
        <h4 class="text-center">Please provide your user name and password</h4>
        <h4 class="text-center">Do not have account yet?
            <a href="signUp.php">Sign up</a>
        </h4>

        <form class="m-5" method="post">

            <div class="row">
                <div class="col">
                    <input class="form-control" type="text" name="username" placeholder="User Name">
                </div>

                <div class="col">
                    <input class="form-control" type="text" name="password" placeholder="Password">
                </div>
            </div>


            <input class="m-5" type="checkbox" name="stayLoggedIn" value=1>Keep me log in

            <div class="text-center m-5">
            <input class="btn btn-success" type="submit" name="submit" value="Log In!">
            </div>

        </form>
    </div>

   
<?php 

include("footer.php");

?>