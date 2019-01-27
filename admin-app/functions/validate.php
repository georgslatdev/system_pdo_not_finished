<?php
    function fetchToken($form) {
      $token = md5(uniqid(microtime(), true));
      $_SESSION['token'][$form] = $token;
      return $token;
    }

    function matchToken($form) {
      if(!isset($_POST['token'][$form]))
      return false;

      if($_POST['token'][$form] === $_SESSION['token'][$form]) {
        $_SESSION['token'][$form] = NULL;
        return true;
      }
        return false;
    }
    session_start();
    ?>
