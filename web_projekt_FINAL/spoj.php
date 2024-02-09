<?php
$servername="localhost";
$username= "root";
$password="";
$dbname="zoo";

$spoj= new mysqli($servername,$username,$password,$dbname);
if(!$spoj){
    die("Spajanje neuspjelo");
}
?>