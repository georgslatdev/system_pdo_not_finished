<?php
    session_start();
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("location: login");
      exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo TITLE ?> | Welcome page</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/skeleton.css">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<div class="container">
  <h1>Sveiks, <b><?php echo $_SESSION['username']; ?></b>. Mūsu mājaslapā.</h1>
    <a href="account.php?id=<?php echo $_SESSION['username']; ?>" class="button">Lietotājs</a>
      <p><a href="logout" class="button">Iziet!</a></p>
</body>
</html>
