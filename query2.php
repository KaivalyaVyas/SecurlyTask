<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "securly_school";
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();


 $studentlist = array();
 $schoolNameq2='' ;
 $cnt=0;
        
if ($conn->connect_error) {
   // die("Connection failed: " . $conn->connect_error);
   // echo('Issue with Data Base connection. Please check that first!!!');
} else{
   // echo( $_POST["q1email"]);
     if( $_SESSION["REQRY2"]!=NULL ){
        $clubq2=$_SESSION["REQRY2"]; $_SESSION["REQRY2"]=NULL;
    }
    else{
        $clubq2=$_POST['clubq2'];
    }
    
    
    
     $sql1 = "INSERT INTO query_history (queryType, param1,param2,adminid)
VALUES ('q2', '$clubq2','',' $_SESSION[adminid]')";
 
 if ($conn->query($sql1) === TRUE) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    
    
    $sql = "select schoolname from school where SchoolId = (select SchoolId from club where clubName = '$clubq2')
";
    
     $result = $conn->query($sql);
     
    $sql2 = "select name from student where student_id in (select distinct student_id from student_club_relation where club_id = (select clubid from club where clubname = '$clubq2'))";
     
}    $result2 = $conn->query($sql2);

if ($result->num_rows > 0) {
    
         while($row = $result->fetch_assoc()) {
        
          // echo  $row["schoolname"] . "<br>" ;
             $schoolNameq2=$row["schoolname"];
             
    }
    $_SESSION["q2schoolname"]=$schoolNameq2;
    }
    
if ($result2->num_rows > 0) {
    
         while($row = $result2->fetch_assoc()) {
        
          // echo  $row["name"]. "<br>";
           $studentlist[$cnt++]=$row["name"];
           
    }
    
    }    
 $_SESSION["studentList"]=$studentlist;
 $_SESSION["lastpage"]='q2';
 header("Location:welcome.php");

