<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Share your views</title>
</head>

<body>
    <!--this below file is attach with header page in partials floder...--->
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    

    <?php

      $id = $_GET['catid'];
      $sql = "SELECT * FROM `categories` where categories_id =$id";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){

      $catname = $row['categories_name'];
      $catdesc = $row['categories_discription'];
     }
  ?>

    <?php
      $showAlert = false;
      $method = $_SERVER['REQUEST_METHOD'];
      if($method == 'POST'){
      // insert into databse from you fill the view from
      $v_title = $_POST['title'];
      $v_desc= $_POST['desc'];

      $v_title = str_replace("<","&lt;", "$v_title");
      $v_title = str_replace(">","&gt;", "$v_title");

      $v_desc = str_replace("<","&lt;", "$v_desc");
      $v_desc = str_replace(">","&gt;", "$v_desc");

      // if you login then your name/email will be show after the post/comment
      $sno = $_POST['sno'];

      $sql = " INSERT INTO `views` ( `view_title`, `view_desc`, `view_categ_id`, `view_user_id`, `timestamp`) VALUES ('$v_title', '$v_desc', '$id', '$sno', CURRENT_TIMESTAMP())";
      $result = mysqli_query($conn, $sql);
      //$showAlert = true;
      if($showAlert){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success</strong> Your Questions has been added please wait for community to respond quickly. 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              </div>';

      }
   }
   ?>

    <div class="container my-4">

        <!-- jumbotorn copy  from bootstrap -->

        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
            <p class="lead"> <?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>This is a perr to perr forums for sharing knowledge and your personal views about topic with each other.
                <br> No Spam / Advertising / Self-promote in the forums.<br> Do not post copyright-infringing
                material.<br> Do not post “offensive” posts, links or images. <br> Do not cross post questions.<br>
                Do not PM users asking for help.<br> Remain respectful of other members at all times.
            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <!--------------------------------------------------------------------->
    <!--If not present any question about topic then show a simple form which ask only 2 thing title and desc about topic. ****** If the php code define if you are not loggedin then you never pass any comment   -->

    <?php

     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ 

      
     echo '<div class="container">
     <h1 class="py-2">Start and Ask any questions about topic related..</h1>
     <form action= "'. $_SERVER["REQUEST_URI"] .'" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Proble title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">keep your proble title as short and crisp as
                    possible.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate your Concern </label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>';
     }
    else{
     echo'
     <div class="d-flex justify-content-center my-5">
       <div class="card w-50">
       <div class="card-body ">
         <h5 class="card-title">Login Please</h5>
         <p class="card-text"> You are not loggedin. please login firstly then you passed any comments otherwise only read the all comments.</p>
         <a href="/forums/index.php" class="btn btn-primary">login link</a>
       </div>
     </div>
     </div>
     ';
    }  
     ?>
    <div class="container mb-5">

        <h1 class="py-2">Browse Questions and your Views</h1>

        <?php

      $id = $_GET['catid'];
      $sql = "SELECT * FROM `views` WHERE view_categ_id =$id";
      $result = mysqli_query($conn, $sql);
      $noResult = true;
      while($row = mysqli_fetch_assoc($result)){
      $noResult = false;
      $id = $row['view_id'];
      $tile = $row['view_title'];
      $desc = $row['view_desc'];
      $view_time = $row['timestamp'];

      // who are comment/post give name in this line..

      $view_user_id = $row['view_user_id'];
      $sql2 = "select user_name from `users` where sno= '$view_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      
        //media object copy from bootstrap 

       echo ' <div class="media my-4">
            <img src="img/user_default.png" width="60px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="font-weight-bold my-0"> Asked by :  '. $row2['user_name'] .' at ' .$view_time . '</p>
                <h5 class="mt-0"><a href="views.php?view_id=' . $id . ' "> '. $tile .'</a></h5>
                '. $desc .'
            </div>
        </div>';

      }
      // if any subject tilte in present no any question aks any users so this container has been show that write only No result found... 

      //echo  var_dump($noResult);
      if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No result found..</p>
          <p class="lead">You are the first person to ask any question in this topic..</p>
        </div>
      </div>';
      }
    ?>




    </div>

    <!--this below file is attach with footer page in partials folder...--->
    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>