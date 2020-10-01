<?php
session_start();

//Copy navbar from bootstap

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Share_Views</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Categaries
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql = "select categories_name, categories_id from `categories` LIMIT 3";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){

       
        echo ' <a class="dropdown-item" href="views_list.php?catid= '. $row['categories_id'] .'">'. $row['categories_name'] . '</a>';
      
        } 
          
      echo' </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="contact.php">Contact</a>
      </li>
    </ul>
    <div class="row mx-2">';
   

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
   
      echo ' <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      <p class="text-light my-0 mx-2">welcome ' . $_SESSION['useremail']. '</p>
      <a href="partials/_logout.php" class="btn btn-outline-success mx-2">Logout</a>
    </form>';
    }
    else
    {

    echo ' <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
           </form>
           <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
           <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Singup</button>';
    }

echo '
  </div>
  </div>
</nav>';

include  'partials/_loginModal.php'; 
include  'partials/_singupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo'   <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> You are Signed-up successfully.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){
  echo'   <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
          <strong>Warning!</strong> Please verify your password.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}
if(isset($_GET['existed']) && $_GET['existed'] == "true"){
  echo'   <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
          <strong>Warning!</strong> Email is already present.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"){
  echo'   <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> You are logged-in successfully.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"){
  echo'   <div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
          <strong>warning!</strong> Some credentials is wrong.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}
?>