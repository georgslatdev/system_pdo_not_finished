<?php
 /* Front-End configuration */

    define('TITLE', 'Framework by Georgs Sorokins');
    //define('DIR','http://localhost/');
    define('DIR','http://localhost/admin/');
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'testing');



    // Connect to MYSQL database
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // set error PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Neizdevās pieslēgties. " . $e->getMessage());
    }

?>
