<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      #maincontainer{
          min-height:100vh;
      }
    </style>    

    <title>Share your views</title>
</head>

<body>
    <!--this below file is attach with header page in partials floder...--->
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

   




  
   <!--- search result -------------------->  
   <div class="container my-3" id= "maincontainer">
   <h1>Search results for <em><?php echo $_GET['search']?></em></h1>

   <?php
   $noresults =true;
    $query = $_GET["search"];
    $sql = "SELECT * FROM views WHERE MATCH (view_title, view_desc) against ('$query')";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
       $title = $row['view_title'];
       $desc = $row['view_desc'];
       $view_id = $row['view_id'];
       $url = "views.php?view_id=" . $view_id ;
       $noresults =false;

       // Display the search result

      echo  '<div class="result">
               <h3> <a href="' . $url . '" class="text-dark">' . $title .'</a> </h3>
               <p> ' . $desc .'</p>
             </div>';
    }
    if($noresults){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No result found..</p>
          <p class="lead">Suggestions:
          <ul>
          <li>Make sure that all words are spelled correctly.</li>
          <li>Try different keywords.</li>
          <li>Try more general keywords.</li>
          </ul>
          </p>
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