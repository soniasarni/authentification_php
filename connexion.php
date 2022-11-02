<?php

  $localhost="localhost";
  $user ="root";
  $password = "";
  $database ="authentification";
  $con = new PDO("mysql:host=$localhost;dbname=$database",$user,$password);
  if($con){
     echo("connected");
  }else{ 
      echo"no connected"; 
 }
// $sql="create database if not exists authentification ";
// $res=$con->query($sql);
// if($res==true){
//     cho"db vient d'etre crée ";
// }else {
//     echo "erreur dans la cration de base" ;
//     echo  $con->error;
// }







?>