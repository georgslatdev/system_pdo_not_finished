<?php
  require_once 'config.php';
    $username = $password = $confirm_password = $surname = $userphone = $email = "";
    $username_err = $password_err = $confirm_password_err = $surname_err = $userphone_err = $email_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Lūdzu ievadiet lietotājvārdu.";
        } else{
            $sql = "SELECT id FROM users WHERE username = :username";
            if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Šādu lietotājvārdu lieto jau cits lietotājs.";
                } else {
                    $username = trim($_POST["username"]);
                } else {
                  echo "Oops! Kaut kas nogāja greizi. Lūdzu, pamēģiniet vēlreiz.";
                }
            }
            unset($stmt);
        }

        if(empty(trim($_POST['surname']))){
            $surname_err = "Lūdzu ievadiet savu uzvārdu.";
        } else {
            $surname = trim($_POST['surname']);
        }
        if(empty(trim($_POST['email']))) {
            $email_err = "Lūdzu ievadiet savu e-pastu.";
        } else {
            $email = trim($_POST['email']);
        }

        if(empty(trim($_POST['userphone']))){
            $userphone_err = "Lūdzu ievadiet savu telefona numuru.";
        } elseif(strlen(trim($_POST['userphone'])) < 8) {
            $userphone_err = "Tālruņa numurs sastāv no 8 cipariem, bez +371.";
        } else {
            $userphone = trim($_POST['userphone']);
        }

        if(empty(trim($_POST['password']))){
            $password_err = "Lūdzu ievadiet paroli.";
        } elseif(strlen(trim($_POST['password'])) < 6){
            $password_err = "Parolei jābūt vismaz 6 rakstzīmēm.";
        } else {
            $password = trim($_POST['password']);
        }

        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = 'Lūdzu, apstipriniet paroli.';
        } else {
            $confirm_password = trim($_POST['confirm_password']);
            if($password != $confirm_password) {
                $confirm_password_err = 'Paroles nesakrita, pameiģiniet vēlreiz.';
            }
        }

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($surname_err) && empty($userphone_err) && empty($email_err))
        {

            $sql = "INSERT INTO users (username, surname, userphone, email, password) VALUES (:username, :surname, :userphone, :email, :password)";

            if($stmt = $pdo->prepare($sql)){

                $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
                $stmt->bindParam(':surname', $param_surname, PDO::PARAM_STR);
                $stmt->bindParam(':userphone', $param_userphone, PDO::PARAM_STR);
                $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);


                $param_username = $username;
                $param_surname = $surname;
                $param_userphone = $userphone;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                if($stmt->execute()){
                    header("location: login");
                } else{
                    echo "Kaut kas nogāja greizi. Lūdzu, pamēģiniet vēlreiz.";
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
      <title><?php echo TITLE ?> | Register page</title>
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
  <h2>Reģistrēties</h2>
    <p>Lūdzu, aizpildiet šo veidlapu, lai izveidotu kontu.</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Vārds<sup>*</sup></label>
          <input type="text" name="username"class="u-full-width" value="<?php echo $username; ?>">
            <p><?php echo $username_err; ?></p>
        </div>

        <div class="form-group <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>">
        <label>Uzvārds:<sup>*</sup></label>
          <input type="text" name="surname"class="u-full-width" value="<?php echo $surname; ?>">
            <p><?php echo $surname_err; ?></p>
        </div>

        <div class="form-group <?php echo (!empty($userphone_err)) ? 'has-error' : ''; ?>">
        <label>Telefons:<sup>*</sup></label>
          <input type="tel" name="userphone"class="u-full-width" value="<?php echo $userphone; ?>">
            <p><?php echo $userphone_err; ?></p>
        </div>

        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <label>E-pasts:<sup>*</sup></label>
          <input type="email" name="email"class="u-full-width" value="<?php echo $email; ?>">
            <p><?php echo $email_err; ?></p>
        </div>

        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Parole:<sup>*</sup></label>
          <input type="password" name="password" class="u-full-width" value="<?php echo $password; ?>">
            <p><?php echo $password_err; ?></p>
        </div>

        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <label>Atkārtojiet paroli:<sup>*</sup></label>
          <input type="password" name="confirm_password" class="u-full-width" value="<?php echo $confirm_password; ?>">
            <p><?php echo $confirm_password_err; ?></p>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">
        </div>
          <p>Jau ir konts? <a href="login">Autorizējies</a>.</p>
      </form>
</div>
</body>
</html>
