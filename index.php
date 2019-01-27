<?php
include('app/functions/validate.php');

session_start();
    require_once 'config.php';

    if(isset($_SESSION['username']) || !empty($_SESSION['username'])){
      header("location: welcome");
      exit;
    }else{
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo TITLE ?> | Home page</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <div class="container">
    <a href="login" class="button">Autorizēties</a>
    <a href="register" class="button">Reģistrēties</a>
    <hr>
    <h1>Esi sveicināts mājaslapā - <b>source.lv</b></h1>
  </div>
</body>
</html>
  <?php
    }
  ?>
