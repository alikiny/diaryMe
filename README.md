# diaryMe
Simple Webapp for writing and saving your notes (Using SQL database, so required a hosting)
Watch the live demo at thenycode.com/diary 


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    
    <!--Bootstrap CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   

    <!-- Google font family : Lobster -->
    <link href="https://fonts.googleapis.com/css?family=Lobster+Two&display=swap" rel="stylesheet">

    <!-- External css file-->
    <link rel="stylesheet" href="style.css">
    
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
    
    <script src="script.js"></script>
    
    <title>Home page</title>
</head>

<body>

<div class="container-fluid" id="theme"></div>
    <div class="bg-logo">
        <div id="logo"></div>
        <a id="logo-text" href="./">diaryMe</a>
        
    </div>
    
    <a class="btn btn-outline-success bg-logo-2 " href="signUp">Start writing</a>
    
    <a class="btn btn-success bg-logo-3" href="logIn"> Log in</a>
    
    <div class="row m-5">
        <div class="col-3">
            <div class="nav flex-column " role="tablist" aria-orientation="vertical">
                <a class="nav-link text-dark active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Why writing?</a>
                <a class="nav-link text-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Why diaryMe?</a>
                <a class="nav-link text-dark" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Why today?</a>

            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ac lacus et libero iaculis convallis ut non erat. Cras et ornare augue. Sed commodo justo tempor, pharetra risus non, gravida enim. Quisque pharetra, est vitae luctus malesuada, ante nulla commodo diam, ac posuere augue justo non massa. Maecenas quis hendrerit elit. Curabitur facilisis metus eu ultricies tristique. Proin et mi erat. Duis vel ligula condimentum diam imperdiet suscipit sit amet id turpis. Aenean id nisi sed sem convallis pretium. Sed ac porttitor massa. Ut malesuada leo eu purus porttitor, ut elementum sapien posuere. Pellentesque euismod vitae est eu lacinia. Integer fermentum maximus nisi, ac scelerisque felis consequat non.

                        Vestibulum fermentum augue lectus. Proin in rhoncus sapien. Aenean ut nisi quis mi congue fringilla. Phasellus imperdiet mollis libero, feugiat sollicitudin ligula eleifend ut. Ut lorem nisl, porta ac lobortis sit amet, ultricies eu dui. Suspendisse fermentum est aliquam sagittis imperdiet. Donec et scelerisque lorem. In vel lobortis tellus. Maecenas nec lorem molestie, euismod leo molestie, sagittis neque. Donec tincidunt, erat a laoreet malesuada, mauris erat iaculis mi, vitae pretium mi felis in tortor. Maecenas erat nunc, tincidunt sit amet nunc id, venenatis finibus elit. Aliquam vulputate quam metus, at posuere tortor ornare quis. Sed egestas sit amet lectus rhoncus pellentesque. Phasellus semper tempus massa, sed facilisis sem suscipit sed. </p>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ac lacus et libero iaculis convallis ut non erat. Cras et ornare augue. Sed commodo justo tempor, pharetra risus non, gravida enim. Quisque pharetra, est vitae luctus malesuada, ante nulla commodo diam, ac posuere augue justo non massa. Maecenas quis hendrerit elit. Curabitur facilisis metus eu ultricies tristique. Proin et mi erat. Duis vel ligula condimentum diam imperdiet suscipit sit amet id turpis. Aenean id nisi sed sem convallis pretium. Sed ac porttitor massa. Ut malesuada leo eu purus porttitor, ut elementum sapien posuere. Pellentesque euismod vitae est eu lacinia. Integer fermentum maximus nisi, ac scelerisque felis consequat non.

                        Vestibulum fermentum augue lectus. Proin in rhoncus sapien. Aenean ut nisi quis mi congue fringilla. Phasellus imperdiet mollis libero, feugiat sollicitudin ligula eleifend ut. Ut lorem nisl, porta ac lobortis sit amet, ultricies eu dui. Suspendisse fermentum est aliquam sagittis imperdiet. Donec et scelerisque lorem. In vel lobortis tellus. Maecenas nec lorem molestie, euismod leo molestie, sagittis neque. Donec tincidunt, erat a laoreet malesuada, mauris erat iaculis mi, vitae pretium mi felis in tortor. Maecenas erat nunc, tincidunt sit amet nunc id, venenatis finibus elit. Aliquam vulputate quam metus, at posuere tortor ornare quis. Sed egestas sit amet lectus rhoncus pellentesque. Phasellus semper tempus massa, sed facilisis sem suscipit sed. </p>

                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ac lacus et libero iaculis convallis ut non erat. Cras et ornare augue. Sed commodo justo tempor, pharetra risus non, gravida enim. Quisque pharetra, est vitae luctus malesuada, ante nulla commodo diam, ac posuere augue justo non massa. Maecenas quis hendrerit elit. Curabitur facilisis metus eu ultricies tristique. Proin et mi erat. Duis vel ligula condimentum diam imperdiet suscipit sit amet id turpis. Aenean id nisi sed sem convallis pretium. Sed ac porttitor massa. Ut malesuada leo eu purus porttitor, ut elementum sapien posuere. Pellentesque euismod vitae est eu lacinia. Integer fermentum maximus nisi, ac scelerisque felis consequat non.

                        Vestibulum fermentum augue lectus. Proin in rhoncus sapien. Aenean ut nisi quis mi congue fringilla. Phasellus imperdiet mollis libero, feugiat sollicitudin ligula eleifend ut. Ut lorem nisl, porta ac lobortis sit amet, ultricies eu dui. Suspendisse fermentum est aliquam sagittis imperdiet. Donec et scelerisque lorem. In vel lobortis tellus. Maecenas nec lorem molestie, euismod leo molestie, sagittis neque. Donec tincidunt, erat a laoreet malesuada, mauris erat iaculis mi, vitae pretium mi felis in tortor. Maecenas erat nunc, tincidunt sit amet nunc id, venenatis finibus elit. Aliquam vulputate quam metus, at posuere tortor ornare quis. Sed egestas sit amet lectus rhoncus pellentesque. Phasellus semper tempus massa, sed facilisis sem suscipit sed. </p>

                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ac lacus et libero iaculis convallis ut non erat. Cras et ornare augue. Sed commodo justo tempor, pharetra risus non, gravida enim. Quisque pharetra, est vitae luctus malesuada, ante nulla commodo diam, ac posuere augue justo non massa. Maecenas quis hendrerit elit. Curabitur facilisis metus eu ultricies tristique. Proin et mi erat. Duis vel ligula condimentum diam imperdiet suscipit sit amet id turpis. Aenean id nisi sed sem convallis pretium. Sed ac porttitor massa. Ut malesuada leo eu purus porttitor, ut elementum sapien posuere. Pellentesque euismod vitae est eu lacinia. Integer fermentum maximus nisi, ac scelerisque felis consequat non.

                        Vestibulum fermentum augue lectus. Proin in rhoncus sapien. Aenean ut nisi quis mi congue fringilla. Phasellus imperdiet mollis libero, feugiat sollicitudin ligula eleifend ut. Ut lorem nisl, porta ac lobortis sit amet, ultricies eu dui. Suspendisse fermentum est aliquam sagittis imperdiet. Donec et scelerisque lorem. In vel lobortis tellus. Maecenas nec lorem molestie, euismod leo molestie, sagittis neque. Donec tincidunt, erat a laoreet malesuada, mauris erat iaculis mi, vitae pretium mi felis in tortor. Maecenas erat nunc, tincidunt sit amet nunc id, venenatis finibus elit. Aliquam vulputate quam metus, at posuere tortor ornare quis. Sed egestas sit amet lectus rhoncus pellentesque. Phasellus semper tempus massa, sed facilisis sem suscipit sed. </p>

                </div>
            </div>
        </div>
    </div>
    
<footer>
        <div class="card text-center">
            <div class="card-header text-center" >
                <a href="#" stye="text-decoration:none; color:darkgreen">GitHub</a>
                <a class="mx-5" href="#" stye="text-decoration:none; color:darkgreen">Facebook</a>
                <a href="#" stye="text-decoration:none; color:darkgreen">Linkedin</a>
            </div>

            <div class="card-body footer-body">
                <h5 class="card-title">Because every second in your life is gorgeous</h5>
                <p class="card-text">We do not record the texts but sustain the moments </p>
                <a href="signUp.php" class="btn btn-success">Start your inspiration</a>
            </div>
            <div class="card-footer text-muted" style="background-color: #47a144">
                @kinycode.com
            </div>
        </div>
    </footer>

    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    
    <!--<script src="js/bootstrap.min.js"></script>-->
    
   
</body>

</html>
