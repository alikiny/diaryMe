<?php

session_start();

//Check if SESSION['id'] is available. if not, redirect the webpage to the home page.
//This is to prevent users jumping directly to the diary page without log in

if (!$_SESSION['id']) {
    header("Location: index.php");
} else {
    include("header.php");
    include("connect.php");
    $query = "SELECT * FROM `users` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'LIMIT 1";

    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    if (isset($row)) {
        $name = $row['username'];
    }

    // $query2 = "SELECT * FROM `diaries` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'";

    // $result2 = mysqli_query($link, $query2);


}

//Search title function
if (array_key_exists('search', $_POST) and $_POST["search"]) {
    $foundEntry="";
    if($_POST['searchTitle']){
        $query = "SELECT * FROM `diaries` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'
        AND title='" . mysqli_real_escape_string($link, $_POST['searchTitle']) . "' ";

        $result = mysqli_query($link, $query);
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_array($result);
            $foundEntry= $row['title'];
            if(file_exists($row['path'])){
                $searchContent=file_get_contents($row['path']);
            }
        }else{
            echo "<div class='container m-5'>Title not found. You can view your entry list ".'<a href="#viewEntry" data-toggle="collapse" aria-expanded="true" aria-controls="viewEntry">here</a></div>';
        }
        

    }else{
        echo "Please enter a title";
    }
}

if (array_key_exists('submit', $_POST) and $_POST["submit"]) {
    $error = "";

    //For new entry, both heading and body text are not allowed to be empty
    if (!$_POST['heading']) {
        $error .= "<p>Title is required</p>";
    } else if (!$_POST['textarea']) {
        $error .= "<p>Your entry is still empty</p>";
    } else {
        $query3 = "SELECT * FROM `diaries` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'
        AND title='" . mysqli_real_escape_string($link, $_POST['heading']) . "' LIMIT 1";

        $result3 = mysqli_query($link, $query3);
        $row3 = mysqli_fetch_array($result3);
        if (isset($row3)) {
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
            $query4 = "INSERT INTO `diaries` (`userId`,`title`,`path`,`date`)
            VALUES ('" . mysqli_real_escape_string($link, $_SESSION['id']) . "', 
            '" . mysqli_real_escape_string($link, $_POST['heading']) . "',
            '" . mysqli_real_escape_string($link, $path) . "',
            '" . mysqli_real_escape_string($link, $date) . "') ";

            if (mysqli_query($link, $query4)) {
                $msg = "Recent entry has been saved!";
            } else {
                echo "Cannot save your entry" . mysqli_error($link);
            }
        }
    }
}

$query5 = "SELECT * FROM `diaries` WHERE userId = '" . mysqli_real_escape_string($link, $_SESSION['id']) . "'";
$result5 = mysqli_query($link, $query5);



?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php">diaryMe</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Welcome, <? echo $name; ?>!<span class="sr-only">(current)</span></a>

            </li>
            <li class="nav-item active">
                <a class="nav-link" data-toggle="collapse" href="#newEntry" aria-expanded="true" aria-controls="newEntry">New Entry<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#viewEntry" data-toggle="collapse" aria-expanded="true" aria-controls="viewEntry">View all entries</a>
            </li>

        </ul>
        <form method ="post" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" placeholder="Enter entry's title" aria-label="Search" type="text" name="searchTitle">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" value="search">Search</button>
        </form>
    </div>
</nav>

<div id="diaryBody">
    
    <div class="container-fluid m-5 collapse show" id="newEntry" data-parent="#diaryBody">
        <h4 style="text-align:center;margin: 40px">Start your new memory today with <a href="index.php">diaryMe</a></h4>
        <p><? if($foundEntry!=""){
                echo '<p>Found you entry: '.$foundEntry.' in the entry list</p>'; 
                echo '<p>File content: '.$searchContent.'</p>';
        } ?></p>
        <div><?php echo $error;
                echo $msg; ?></div>
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

    <div class="container-fluid m-5 collapse " id="viewEntry" data-parent="#diaryBody">
        <h4 style="text-align:center;margin: 40px"> <a href="index.php">diaryMe</a> Your memories are precious!</h4>
        <p id="msg"></p>

        <div class="row">

            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">

                    <?php
                    print_r($entries);
                    $i = 1;
                    //Fetch the $results5() to array to extract the title and path of all the entries belong to current user
                    while ($entries = mysqli_fetch_array($result5)) {


                        echo '<a class="list-group-item list-group-item-action" data-toggle="list" href="#list-' . $i . '" role="tab">'
                            . "Entry No." . $i . ": " . $entries['title'] . '<a href="unlink.php?filepath='.$entries['path'].'">Delete</a></a>';
                        $i++;
                    }

                    //after fetching array, the pointer now is at the end, to start fetching again, we 
                    //to set the pointer to the begining of the array.
                    mysqli_data_seek($result5, 0);



                    ?>

                </div>

            </div>

            <div class="col-8">
                <div class="tab-content">
                    <?php

                    $j = 1;
                    //without setting the mysqli_data_seek to 0, the new fetch loop will return null
                    while ($entries = mysqli_fetch_array($result5)) {
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
</div>





<?php
include("footer.php");
?>

<script type="text/javascript">
    //display the msg from unlink.php page to this page
    (function(){
        
        
        document.getElementById("msg").innerHTML=sessionStorage.getItem("unlink");
        
        if(sessionStorage.getItem("index")=="viewEntry"){
            document.getElementById("newEntry").classList.remove("show");
            document.getElementById("viewEntry").classList.add("show");
        }
        sessionStorage.removeItem("index");
        sessionStorage.removeItem("unlink");
    })();
   
</script>
