<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo $_POST['querytype'];
echo $_POST['param1'];
echo $_POST['param2'];
session_start();

if($_POST['querytype']=='q1'){
   $_SESSION["REQRY1"]=$_POST['param1'];
   header("Location:query1.php");
}
if($_POST['querytype']=='q2'){
   $_SESSION["REQRY2"]=$_POST['param1'];
    header("Location:query2.php");
}
if($_POST['querytype']=='q3'){
   $_SESSION["REQRY31"]=$_POST['param1'];
   $_SESSION["REQRY32"]=$_POST['param2'];
   header("Location:query3.php");
}
?>