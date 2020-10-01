<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>discussion about your Questions</title>
</head>

<body>
    <!--this below file is attach with header page in partials floder...--->
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    

  <?php

      $id = $_GET['view_id'];
      $sql = "SELECT * FROM `views` where view_id =$id";
      $result = mysqli_query($conn, $sql);
      $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
      $noResult = false;
      $title = $row['view_title'];
      $desc = $row['view_desc'];
      $view_user_id = $row['view_user_id'];

      // query the user table to find out the name of posted
      $sql2 = "select user_name from `users` where sno='$view_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $posted_by = $row2['user_name'];
     }
  ?>
<!----This is only comment table database link---->
<?php
      $showAlert = false;
      $method = $_SERVER['REQUEST_METHOD'];
      if($method == 'POST'){
      // insert into databse from you fill the comment from
      $comment = $_POST['comment'];

      // if any person any place is used angular baraket then website is not working so i will used str-replace function

      $comment = str_replace("<","&lt;", "$comment");
      $comment = str_replace(">","&gt;", "$comment");
      // if you login then your name/email will be show after the post/comment
      
      $sno = $_POST['sno'];
    
      $sql = " INSERT INTO `comments` ( `comment_content`, `view_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', CURRENT_TIMESTAMP)";
      $result = mysqli_query($conn, $sql);
      $showAlert = true;
      if($showAlert){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success</strong> Your comment has been added.. 
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
            <h1 class="display-4"><?php echo $title;?> Forums</h1>
            <p class="lead"> <?php echo $desc;?> </p>
            <hr class="my-4">
            <p>This is a perr to perr forums for sharing knowledge and your personal views about topic with each other.
                <br> No Spam / Advertising / Self-promote in the forums.<br> Do not post copyright-infringing
                material.<br> Do not post “offensive” posts, links or images. <br> Do not cross post questions.<br>
                Do not PM users asking for help.<br> Remain respectful of other members at all times.
            </p>
           <p><b>Posted by: <?php echo $posted_by;?></b></p>
        </div>
    </div>
     
<!---------------------this is comment form ****** If the php code define if you are not loggedin then you never pass any comment----------------------------->  

<?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ 
    echo'<div class="container">
     <h1 class="py-2">Post a comment topic related..</h1>
     <form action= "'. $_SERVER['REQUEST_URI'] .'" method="POST">
           
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comments. </label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
  </div>';
}
else{
 echo'
 <div class="d-flex justify-content-center my-5">
   <div class="card w-50">
   <div class="card-body ">
     <h5 class="card-title">Login Please</h5>
     <p class="card-text"> You are not loggedin. please login firstly then you passed any post otherwise only read the all post .</p>
     <a href="/forums/index.php" class="btn btn-primary">login link</a>
   </div>
 </div>
 </div>
 ';
}  
 ?>

    <!--------------------------------------------------------------------->

    <div class="container mb-5">

      <h1 class="py-2">Discussions</h1>
    <?php

       $id = $_GET['view_id'];
       $sql = "SELECT * FROM `comments` WHERE view_id =$id";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
       $id = $row['comment_id'];
       $content = $row['comment_content'];
       $comment_time = $row['comment_time'];

       // who are comment/post give name in this line..  

       $comment_by = $row['comment_by'];
       $sql2 = "select user_name from `users` where sno= '$comment_by'";
       $result2 = mysqli_query($conn, $sql2);
       $row2 = mysqli_fetch_assoc($result2);

    //media object copy from bootstrap 

       echo ' <div class="media my-4">
            <img src="img/user_default.png" width="60px" class="mr-3" alt="...">
            <div class="media-body">
               <p class="font-weight-bold my-0">Asked by :  '. $row2['user_name'] .'  at ' .$comment_time . '</p>
                '. $content .'
            </div>
        </div>';

      }
      
      if($noResult){
  echo '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="display-4">No views found..</p>
    <p class="lead">You are the first person to ask any question in this topic..</p>
  </div>
</div>';
}

?> 
    

   
<!-- if any subject tilte in present no any question aks any users so this container has been show that write only No result found... 

//echo  var_dump($noResult);-->



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