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
<style>
.container {
            
            margin-bottom:20px;
}
</style>
<body>
    <!--this below file is attach with header page in partials floder...--->
    
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <!--------Copy the card--------------->
    <div class="d-flex justify-content-center my-5">
        <div class="card">
            <div class="card-header">
                Contact us
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>If you have any problem and any question please contact by our below form.</p>
                    <footer class="blockquote-footer">Contact us:- <cite title="Source Title">Ravi Kumar</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
   
   <!-----contact us forms-----------------------> 

   <?php

  

  if(isset($_POST['username']) && isset($_POST['useremail']) &&isset($_POST['usermobileno']) && isset($_POST['usermessage']))

{

    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usermobileno = $_POST['usermobileno'];
    $usermessage = $_POST['usermessage'];

    $sql = "INSERT INTO `contact_us` (`username`, `useremail`, `usermobileno`, `usermessage`, `time`) VALUES ('$username', '$useremail', '$usermobileno', '$usermessage', CURRENT_TIMESTAMP)";

    //if($is_insert == TRUE)

    $result = mysqli_query($conn, $sql);
    if($result = true){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your comment has been added.. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        exit();
    }
}


?>
  <!---------------Start a html file-------------------> 
   <div class="container" style="max-width:600px">
   <h2>Fill your form</h2>
   <form action="" method="POST">
  <div class="form-group">
    <label for="username">User Name</label>
    <input type="text" class="form-control" id="username" name="username" required aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="useremail">User Email</label>
    <input type="email" class="form-control" id="useremail" name="useremail" required aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="usermobileno">Mobile No</label>
    <input type="number" class="form-control" id="usermobileno" name="usermobileno" required>
  </div>
  <div class="form-group">
    <label for="usermessage">Write your message here..</label>
    <textarea class="form-control" id="usermessage" name="usermessage"required rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary align-item-center" >Submit</button>
</form>
</div>
<!--------------------------------------------------------------------------------->  


<!------------------------------------------------------------------------------------>
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