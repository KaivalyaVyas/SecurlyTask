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
} else {
    // ec
    
    if( $_SESSION["REQRY31"]!=NULL && $_SESSION["REQRY32"]!=NULL  ){
        $email1q3=$_SESSION["REQRY31"]; $_SESSION["REQRY31"]=NULL;
        $email2q3=$_SESSION["REQRY32"]; $_SESSION["REQRY32"]=NULL;
    }
    else{
       
        $email1q3=$_POST['email1q3'];
        $email2q3=$_POST['email2q3'];        
    }
    
    
    
        $sql1 = "INSERT INTO query_history (queryType, param1,param2,adminid)
VALUES ('q3', '$email1q3','$email2q3',' $_SESSION[adminid]')";
 
 if ($conn->query($sql1) === TRUE) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    $firstid;
    $secondid;
    $firstSchool;
    $secondSchool;

    $firstidClublist = array();
    $cnt1 = 0;
    $firstidClublistflag = array();
    $secondidClublist = array();
    $cnt2 = 0;
    $cnt3 = 0;

    $tempStudentList = array();
    $clubq = array();
    $cnt4 = 0;

    $_SESSION["resultq3"] = "PLAIN";

    $sql1 = "SELECT SchoolName FROM school where SchoolId = (select SchoolId from student where Email = '$email1q3');";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {

            $firstSchool = $row["SchoolName"];
        }
    }

    $sql2 = "SELECT SchoolName FROM school where SchoolId = (select SchoolId from student where Email = '$email2q3');";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {

            $secondSchool = $row["SchoolName"];
        }
    }

    if ($firstSchool != $secondSchool) {

        $_SESSION["resultq3"] = "DIFFSCHOOL";
        $_SESSION["lastpage"] = 'q3';
//echo "DIFFSCHOOL";
        header("Location:welcome.php");
    } else {
        $sql3 = "select clubname from club where clubid in (select distinct club_id from student_club_relation where student_id in (select student_id from student where email = '$email1q3') )";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {

            while ($row = $result3->fetch_assoc()) {

                $firstidClublist[$row["clubname"]] = $row["clubname"];
                $firstidClublistflag[$row["clubname"]] = FALSE;
                // $clubq[$cnt4++]==$row["clubname"];
            }
        }



        $sql4 = "select clubname from club where clubid in (select distinct club_id from student_club_relation where student_id in (select student_id from student where email = '$email2q3') )";
        $result4 = $conn->query($sql4);

        if ($result4->num_rows > 0) {

            while ($row = $result4->fetch_assoc()) {

                $secondidClublist[$cnt2++] = $row["clubname"];
            }
        }

        foreach ($firstidClublist as $val) {
            if (empty(firstidClublistflag[$row[$val]]) && !$firstidClublistflag[$row[$val]]) {
                $firstidClublistflag[$row[$val]] = TRUE;

                $tempSQL = "
select clubname from club where clubid in (select distinct club_id from student_club_relation where student_id in ( select distinct student_id from student_club_relation where club_Id in (select clubId from club where clubname= '$val')))";

                $temprResult = $conn->query($tempSQL);
                if ($temprResult->num_rows > 0) {

                    while ($row = $temprResult->fetch_assoc()) {

                        if (empty($firstidClublist[row["clubname"]])) {
                            $firstidClublist[row["clubname"]] = row["clubname"];
                            $firstidClublistflag[row["clubname"]] = FALSE;
                        }
                    }
                }
            }
        }



        foreach ($secondidClublist as $val) {
            foreach ($firstidClublist as $val2) {

                if (!empty($firstidClublist[$val])) {
                    $_SESSION["resultq3"] = "MATCHED";
                }
            }
        }

        if ($_SESSION["resultq3"] == "MATCHED") {
            echo 'MATCHED';
        }
        if ($_SESSION["resultq3"] == "DIFFSCHOOL") {
            echo 'DIFFSCHOOL';
        }

        if ($_SESSION["resultq3"] == "PLAIN") {
            echo 'school same but not connected';
        }

        $_SESSION["lastpage"] = 'q3';
        header("Location:welcome.php");
    }
}