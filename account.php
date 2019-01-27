<?php
session_start();
require_once 'config.php';

  $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
  $pdo->lastInsertID();
  $query = 'SELECT username,surname,email FROM users ORDER BY surname';
  $result = array();
  $sth = $pdo->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo TITLE ?> | Account page</title>
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
  <h1>Hello, <b><?php echo $_SESSION['username']; ?></b>.</h1>
    <hr>
    <h6>Lietotāja profils</h6>
    <?php foreach($pdo->query("SELECT * From Users") as $result) { ?>
      <div class="form-group">
        <label>Vārds</label>
          <input type="text" name="username"class="u-full-width" readonly="readonly" value="<?php echo $result['username']; ?>">
      </div>

      <div class="form-group">
        <label>Uzvārds</label>
          <input type="text" name="surname"class="u-full-width" readonly="readonly" value="<?php echo $result['surname'];; ?>">
      </div>

      <div class="form-group">
        <label>Telefons</label>
            <input type="text" name="userphone"class="u-full-width" readonly="readonly" value="<?php echo $result['userphone']; ?>">
      </div>

      <div class="form-group">
        <label>E-pasts</label>
          <input type="email" name="email"class="u-full-width" readonly="readonly" value="<?php echo $resul['email']; ?>">
      </div>

      <?php } ?>
        <p><a href="logout" class="button">Iziet!</a></p>

</body>

</html>
