<?php
    $id = $_GET['id'];
     $sendToArray = array("wadokikai.com@gmail.com", 
         "bob (at) timlin.net", 
         "avbrambila (at) gmail.com", 
         "Larry_Watford (at) yahoo.com", 
         "a.corpuz (at) comcast.net", 
         "allennunley (at) aol.com ",
         "donald (at) stasenka.com", 
         
           "david.okeefe (at) gmail.com",
         "bob (at) timlin.net",
         "",
         "wadokikai.msac (at) gmail.com"); 
     
     echo "Email: " .$sendToArray[$id];
?>