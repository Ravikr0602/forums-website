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
  



    <!------------Sliding bar copy with help of bootstrap---------------->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">

                <!--- src is going to unplash images api then click first click then scroll down and paste the link with random search term--->
                <img src="img/silder1.jpg"class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/silder4.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/silder2.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-------------------------------------------------->


    <div class="container my-3">

        <h2 class="text-center">Welcome to Share_your_views.. If any thought please share with us..</h2>
        <h2 class="text-center">Here present Some Browse Categories.</h2>

        <!--Copy card design from bootstrap--->

        <div class="row">
       
      <!---Fetch all the categories from database --->
      <!--Use a while loop to use fetch all categories present in databse come to here.-->
       <?php

       $sql = "SELECT * FROM `categories`";
       $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        // echo $row['categories_id'];
        // echo $row['categories_name'];
         $cat = $row['categories_name'];
         $desc = $row['categories_discription'];
         $id =  $row['categories_id'];

        echo '<div class="col-md-4 my-2">
               <div class="card" style="width: 18rem;">
                     <img src="img/card'. $id . '.jpg " class="card-img-top" alt="image for this categories">
                  <div class="card-body">
                       <h5 class="card-title"><a href="views_list.php?catid=' . $id . '">' .$cat . '</a></h5>
                       <p class="card-text">' . substr($desc, 0, 255). '....</p>
                       <a href="views_list.php?catid=' . $id . '" class="btn btn-primary">Share_Views</a>
                  </div>
                </div>
              </div>';
        }
       ?>
     
      </div>

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