<?php
    require 'config.php';

    function getUsersData($id) {

      $sql = "SELECT * FROM users WHERE id = :id";

      while($result = mysql_fetch_assoc($q)) {
        $array['id'] = $result['id'];
        $array['username'] = $result['username'];
      }
      return $array;
    }

    function getID($username) {
      $sql = "SELECT `id` FROM `users` WHERE `username` ='".$username."'";

      while($r = mysql_fetch_assoc($q)) {
        return $result['id'];
      }

    }
