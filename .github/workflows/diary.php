<?php

include_once('functions.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = "";

//Check if SESSION['id'] is available. if not, redirect the webpage to the home page.
//This is to prevent users jumping directly to the diary page without log in

if (!$_SESSION['id']) {
    header("Location: index.php");
} else {

    include("header.php");
    include("connect.php");
    $userInfo = fetchUserInfo();
    $row = mysqli_fetch_array($userInfo);
    if (isset($row)) {
        $name = $row['username'];
        $userEmail = $row['email'];
        $userAge = $row['age'];
        $userCountry = $row['country'];
        $userCity = $row['city'];
        if (!$userCountry) {
            $userCountry = "Unknown";
        }
        if (!$userCity) {
            $userCity = "Unknown";
        }
    } else {
        echo $userInfo;
    }
}

//logout function
if (array_key_exists('logout', $_POST) and $_POST["logout"]) {
    session_unset();
    setcookie("id", "", time() - 60 * 60);
    header("Location: index.php");
}

//Search title function
if (array_key_exists('search', $_POST) and $_POST["search"]) {
    $foundEntry = "";
    if ($_POST['searchTitle']) {
        echo searchTitles($_POST['searchTitle']);
    } else {
        echo "Please enter a title";
    }
}

//Fetch all diaries database (used for print out list of entries later)
$query = "SELECT * FROM `diaries` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'";
$diaries = validateQuery($query);


//Write new entry function
$saveEntry="";
if (array_key_exists('submit', $_POST) and $_POST["submit"]) {
    $error = "";

    //For new entry, both heading and body text are not allowed to be empty
    if (!$_POST['heading']) {
        $error .= "<p>Title is required</p>";
    } else if (!$_POST['textarea']) {
        $error .= "<p>Your entry is still empty</p>";
    } else {
        $query= "SELECT * FROM `diaries` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'
        AND title='" . mysqli_real_escape_string($link, $_POST['heading']) . "' LIMIT 1";

        $result = validateQuery($query);
        $row = mysqli_fetch_array($result);
        if (isset($row)) {
            $error = "<p>The heading is already taken by you before</p>";
        } else {
            //Create a path to save new entry's content to the server
            $path = $_SERVER['DOCUMENT_ROOT'] . '/Entry/' . preg_replace('/\s/', '', $_POST['heading']);
            $myfile = fopen($path, "w");
            fwrite($myfile, $_POST['textarea']);
            fclose($myfile);
            date_default_timezone_set("EET");
            $date = date("Y/m/d");

            //Save new entry's title and path to the SQL database
            $query = "INSERT INTO `diaries` (`userId`,`title`,`path`,`date`)
            VALUES ('" . mysqli_real_escape_string($link, $_SESSION['id']) . "', 
            '" . mysqli_real_escape_string($link, $_POST['heading']) . "',
            '" . mysqli_real_escape_string($link, $path) . "',
            '" . mysqli_real_escape_string($link, $date) . "') ";

            if (mysqli_query($link, $query)) {
                $saveEntry = "Recent entry has been saved!
                <p><a href='diary.php'>Refresh</a> the page to update all the entries</p>";
            } else {
                echo $saveEntry= "Cannot save your entry" . mysqli_error($link);
            }
        }
    }
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php">diaryMe</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" data-toggle="collapse" href="#user-info">Welcome, <? echo $name; ?>!<span class="sr-only">(current)</span></a>

            </li>
            <li class="nav-item active">
                <a class="nav-link" data-toggle="collapse" href="#newEntry" aria-expanded="true" aria-controls="newEntry">New Entry<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#viewEntry" data-toggle="collapse" aria-expanded="true" aria-controls="viewEntry">View all entries</a>
            </li>
            <li class="nav-item active">
                <form method="post">
                    <button class="btn my-3 my-sm-0 text-success" type="submit" name="logout" value="logout">Log out</button>
                </form>

            </li>

        </ul>
        <form method="post" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" placeholder="Enter entry's title" aria-label="Search" type="text" name="searchTitle">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" value="search">Search</button>
        </form>
    </div>
</nav>

<div id="diaryBody">

    <!-- This is the collapsed part, which allows users to write new entry -->
    <div class="container-fluid m-5 collapse show" id="newEntry" data-parent="#diaryBody">
        <h4 style="text-align:center;margin: 40px">Start your new memory today with <a href="index.php">diaryMe</a></h4>

        <? echo $saveEntry;
            echo $error;?>
        <form method="post">
            <div class="form-group">
                <label for="heading">Title</label>
                <input type="text" class="form-control" id="heading" name="heading" placeholder="The untold story ...">
            </div>
            <div class="form-group">
                <label for="catergory">Category</label>
                <select class="form-control" id="catergory" name="catergory">
                    <option>Daily diary</option>
                    <option>Note</option>
                    <option>To-do List</option>
                    <option>Meal plan</option>
                    <option>Financial control</option>
                </select>
            </div>

            <div class="form-group">
                <label for="textarea">Input</label>
                <textarea class="form-control" id="textarea" name="textarea" placeholder="Start writing" rows="10">
            </textarea>
            </div>

            <input type="submit" class="btn btn-success" name="submit" value="Save">
        </form>
    </div>

    <!-- This is the collapsed part, which allows users to view all the entries and delete -->
    <div class="container-fluid m-5 collapse " id="viewEntry" data-parent="#diaryBody">
        <h4 style="text-align:center;margin: 40px"> <a href="index.php">diaryMe</a> Your memories are precious!</h4>
        <p id="msg"></p>

        <div class="row">

            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">

                    <?php

                    $i = 1;
                    //Fetch the $diaries to array to extract the title and path of all the entries belong to current user
                    while ($entries = mysqli_fetch_array($diaries)) {


                        echo '<a class="list-group-item list-group-item-action" data-toggle="list" href="#list-' . $i . '" role="tab">'
                            . "Entry No." . $i . ": " . $entries['title'] . '<a href="unlink.php?filepath=' . $entries['path'] . '">Delete</a></a>';
                        $i++;
                    }

                    //after fetching array, the pointer now is at the end, to start fetching again, we 
                    //to set the pointer to the begining of the array.
                    mysqli_data_seek($diaries, 0);



                    ?>

                </div>

            </div>

            <div class="col-8">
                <div class="tab-content">
                    <?php

                    $j = 1;
                    //without setting the mysqli_data_seek to 0, the new fetch loop will return null
                    while ($entries = mysqli_fetch_array($diaries)) {
                        $file = fopen($entries['path'], 'r') or die("Unable to open file!");
                        $content = file_get_contents($entries['path']);


                        echo '<div class="tab-pane fade" id="list-' . $j . '" role="tabpanel">' .
                            $content . '</div>';
                        $j++;
                    }


                    ?>

                </div>



            </div>
        </div>

    </div>


    <!-- This is the collapsed part, which allows users to view and modify personal info -->
    <div class="container-fluid m-5 row collapse " data-parent="#diaryBody" id="user-info">

        <div class="col">
            <p>User name: <span id='user-name'><? echo $name; ?></span></p>
            <p>Email: <span id='user-email'><? echo $userEmail; ?></span></p>
            <p>Age: <span id='user-age'><? echo $userAge; ?></span></p>
            <p>Country: <span id='user-country'><? echo $userCountry; ?></span></p>
            <p>City: <span id='user-city'><? echo $userCity; ?></span></p>
            <br>
            <br>
            <a data-toggle="collapse" href="#change-info" style="cursor:pointer">Edit profile</a>
            <p id="updated-data"></p>

        </div>

        <div class="col collapse" id="change-info" style="width:30%">


            <div class="form-group row">
                <label for="new-name" class="col-sm-2 col-form-label">User name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="new-name">
                </div>
            </div>

            <div class="form-group row">
                <label for="new-email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="new-email">
                </div>
            </div>
            <div class="form-group row">
                <label for="new-password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="new-password" placeholder="Password">
                </div>
            </div>

            <div class="form-group row">
                <label for="new-age" class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="new-age">
                </div>
            </div>

            <div class="form-group row">
                <label for="new-country" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="new-country">
                </div>
            </div>

            <div class="form-group row">
                <label for="new-city" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="new-city">
                </div>
            </div>

            <a onclick="modifyInfo()" style="cursor:pointer">Save changes</a>
        </div>

    </div>
</div>





<?php
include("footer.php");
?>