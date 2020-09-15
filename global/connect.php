<?php 

$server="mysql:dbname=".db.";host=".server;

try {
    $pdo = new PDO($server,user,pass,
    array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
);

// echo "<script>alert('connected to db')</script>";

} catch (PDOException $e) {
    // echo "<script>alert('error')</script>";
}

?>