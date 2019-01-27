<?php
include('app/functions/validate.php');
    if(matchToken('send')) {
        echo true;
    }
    require_once 'config.php';
    $username = $password = "";
    $username_err = $password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = 'Please enter username.';
        } else {
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST['password']))){
            $password_err = 'Please enter your password.';
        } else {
            $password = trim($_POST['password']);
        }

        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT username, password FROM users WHERE username = :username";
            if($stmt = $pdo->prepare($sql)){

                $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
                $param_username = trim($_POST["username"]);

            if($stmt->execute()){
            if($stmt->rowCount() == 1){
            if($row = $stmt->fetch()){
              $hashed_password = $row['password'];
            if(password_verify($password, $hashed_password)){

            session_start();
            $_SESSION['username'] = $username;
            header("location: welcome");
            } else {
              $password_err = 'The password you entered was not valid.';
            }
          }
          } else {
              $username_err = 'No account found with that username.';
          }
            } else {
              echo "Oops! Something went wrong. Please try again later.";
            }
          }
          unset($stmt);
        }
      unset($pdo);
    }
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
  <h2>Autorizēties</h2>
    <p>Lūdzu aizpildiet visus laukus.</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Lietotājvārds<sup>*</sup></label>
        <input type="text" name="username"class="u-full-width" value="<?php echo $username; ?>">
        <p><?php echo $username_err; ?></p>
      </div>

      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Parole:<sup>*</sup></label>
        <input type="password" name="password" class="u-full-width">
        <p><?php echo $password_err; ?></p>
      </div>

      <div class="form-group">
        <input type="hidden" name="token[send]" value="<?php echo fetchToken('send'); ?>" />
        <input type="submit" class="btn btn-primary" value="Ienākt">
      </div>
      <p>Neesi vel reģistrējies? <a href="register">Reģistrēties</a>.</p>
    </form>
</div>
</body>
</html>
