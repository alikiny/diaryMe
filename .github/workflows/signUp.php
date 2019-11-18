<?php
session_start();

// Despite the JS validatation, PHP validation is still needed
// in case browser turns off JS
$error = "";
if($_POST){
    include("connect.php");
    if (!$_POST["email"]) {
        $error .= "Email is required <br>";
    }
    if (!$_POST["password"]) {
        $error .= "Password cannot be empty<br>";
    }
    if ($_POST["password2"] != $_POST["password"]) {
        $error .= "Password does not match<br>";
        
    }
    if (!$_POST["userName"]) {
        $error .= "User name is required<br>";
    }
    if ($_POST["email"] && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error .= "Invalid email format<br>";
      }
    
    if ($error!=""){
        $error= '<div class="alert alert-warning" role="alert"><p>There is error(s) in your form:</p>'.$error.'</div>';
    }  else{
        $email=$_POST["email"];
        $username=$_POST["userName"];
        $password=$_POST["password"];
        $country=$_POST["country"];
        $city=$_POST["city"];
        $age=$_POST["age"];

        $query="SELECT userId FROM `users` WHERE username='".mysqli_real_escape_string($link, $username)."' LIMIT 1";
        $result= mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0){
                $error="The user name is already taken";
                
            }else{
                $query="INSERT INTO `users`(`username`,`email`,`password`,`country`,`city`,`age`)
                VALUES (
                    '".mysqli_real_escape_string($link,$username)."',
                    '".mysqli_real_escape_string($link,$email)."',
                    '".mysqli_real_escape_string($link,$password)."',
                    '".mysqli_real_escape_string($link,$country)."',
                    '".mysqli_real_escape_string($link,$city)."',
                    '".mysqli_real_escape_string($link,$age)."'
                )";

                if(mysqli_query($link, $query)){
                    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$password)."' WHERE userId = ".mysqli_insert_id($link)." LIMIT 1";

                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);
                        header("Location: login.php");
                }else{
                    echo "Unable to sign up";
                }
            }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign up form</title>
</head>

<body>
    <div class="container m-5 text-center">
        <h1>Sign Up Form</h1>
        <h5>Please provide the following information
            <p>Already have an account?
                <a href="logIn.php">Log in</a>
            </p>
        </h5>

        <div id="error"><? echo $error ?></div>

    </div>
    <div class="container m-5">
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="userName">User name</label>
                    <input type="text" class="form-control" id="userName" placeholder="User name" name="userName">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group col-md-6">
                    <label for="password2">Retype password</label>
                    <input type="password" class="form-control" id="password2" placeholder="Retype password" name="password2">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputCountry">Country</label>
                    <input type="text" class="form-control" id="inputCountry" placeholder="England, Australia, Finland, etc." name="country">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="NewYork, Sydney, Helsinki, etc." name="city">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAge">Age</label>
                    <input type="text" class="form-control" id="inputAge" placeholder="Enter number only " name="age">
                </div>

            </div>


            <button id="submit" type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/JavaScript">

        $("form").submit(function(stopSubmit){
           
            var error="";
            if ($("#email").val() == ""){
                error+="<p>Email cannot be empty</p>";
            }
            if ($("#userName").val() == "") {
                error+="<p>User name cannot be empty</p>";
            }
            if($("#password").val()==""){
                error+="<p>Password cannot be empty</p>";
            }
            if($("#password2").val() == ""){
                error+="<p>You must retype the password</p>";
            }

            if($("#password2").val() != $("#password").val()){
                error+="<p>Password does not match</p>";
            }
            

            if (error != "") {
                  
                  $("#error").html('<div class="alert alert-warning" role="alert"><p>\
                  There is error(s) in your form:</p>'+error+'</div');
                   
                   return false;
                   
               } else {
                   
                $("form").unbind("submit").submit();
/*   remove the envent handler on submit, then submit the form again. 
Without adding .submit() in the end, this form will just be validated,
but not submitted. */
               }
               
        });
    
    </script>
</body>

</html>