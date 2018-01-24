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

        
if ($conn->connect_error) {
   // die("Connection failed: " . $conn->connect_error);
   // echo('Issue with Data Base connection. Please check that first!!!');
} else{
    if( $_SESSION["REQRY1"]!=NULL ){
        $q1email=$_SESSION["REQRY1"]; $_SESSION["REQRY1"]=NULL;
    }
    else{
        $q1email=$_POST['q1email'];
    }
    
   // echo( $_POST["q1email"]);
    $sql = "
select c.clubName,(select SchoolName from school where schoolId = c.schoolId) as school from club c where clubId in
(
SELECT distinct club_id FROM securly_school.student_club_relation where student_id=(select student_id from student where Email ='$q1email'))";
    
 $result = $conn->query($sql);
 $clublist = array();
 $schoolName='' ;
 $cnt=0;
 
 $sql1 = "INSERT INTO query_history (queryType, param1,param2,adminid)
VALUES ('q1', '$q1email','',' $_SESSION[adminid]')";
 
 if ($conn->query($sql1) === TRUE) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
 
 if ($result->num_rows > 0) {
    
         while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["district_officer_id"]. " - Name: " . $row["password"]. " " . $row["password"]. "<br>";
           echo  $row["clubName"]."-----".$row["school"]. "<br>";
             $items[$cnt++]=$row["clubName"];
             $schoolName=$row["school"];
    }
    }
    $_SESSION["lastpage"]='q1';
    
   $_SESSION["clubList"]=$items;
   $_SESSION["school"]=$schoolName;
   
   header("Location:welcome.php");
 
 
    
    
}
?>