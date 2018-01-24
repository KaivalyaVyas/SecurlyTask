
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="myCSS.css">
    </head>>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "securly_school";
        $conn = new mysqli($servername, $username, $password, $dbname);

        session_start();

        if (!isset($_SESSION['clubList']) && !isset($_SESSION['studentList']) && !isset($_SESSION['resultq3'])) {
            $_SESSION['lastpage'] = '';
        }

        $flag = FALSE;



        if ($_SESSION["lastpage"] == '') {
            $_SESSION["adminid"] = $_POST["name"];
            if ($conn->connect_error) {
                // die("Connection failed: " . $conn->connect_error);
                //echo('Issue with Data Base connection. Please check that first!!!');
            } else {
                //echo('sucess!!!');
                $sql = "SELECT district_officer_id,password FROM officer_authantication";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["district_officer_id"]. " - Name: " . $row["password"]. " " . $row["password"]. "<br>";
                        if (($row["district_officer_id"] == $_POST["name"]) && ($row["password"] == $_POST["pwd"])) {
                            $flag = TRUE;

                            //  echo 'matched!!!';
                        } else {
                            // echo 'no match found';
                        }
                    }
                }
            }
        }
        ?>

        <?php if ($flag == 1 || $_SESSION["lastpage"] == 'q1' || $_SESSION["lastpage"] == 'q2' || $_SESSION["lastpage"] == 'q3') { ?>  

            <div>  
                <div id="query1">

                    <form action="query1.php" method="post">
                        Email: <input type="text" name="q1email"><br>
                        <input type="submit" name="submit" >
                    </form>  
                    <?php
                    if (!empty($_SESSION['school'])) {
                        echo " <h3> This student studies at $_SESSION[school] </h3> <br> ";

                        $_SESSION['school'] = NULL;
                    }
                    if (!empty($_SESSION['clubList'])) {
                        echo " <h3> This student is associated in below clubs </h3>  ";
                        foreach ($_SESSION['clubList'] as $val) {
                            echo "<h4>$val</h4>";
                        }
                        $_SESSION['clubList'] = NULL;
                    }
                    ?>      



                </div>
                <div id ="gap"></div>
                <div id="query2">
                    <form action="query2.php" method="post">
                        Club Name: <input type="text" name="clubq2"><br>
                        <input type="submit" name="submit" >
                    </form> 

                    <?php
                    if ($_SESSION["lastpage"] == 'q2') {
                        if (!empty($_SESSION["q2schoolname"])) {
                            echo "<h4>club is from school : $_SESSION[q2schoolname]</h4>";
                            $_SESSION["q2schoolname"] = NULL;
                        }

                        if (!empty($_SESSION["studentList"])) {


                            echo " <h3> Below are student names with club </h3> <br> ";
                            foreach ($_SESSION['studentList'] as $val) {
                                echo "<h4>$val</h4>";
                            }
                            $_SESSION["studentList"] = NULL;
                        }
                    }
                    ?>

                </div>
                <div id ="gap"></div>
                <div id="query3">
                    <form action="query3.php" method="post">
                        First Emailid: <input type="text" name="email1q3"><br>
                        Second Emailid: <input type="text" name="email2q3"><br>
                        <input type="submit" name="submit" >
                    </form> 

                    <?php
                    if ($_SESSION["lastpage"] == 'q3') {
                        //echo "hiii " . $_SESSION["resultq3"];
                        if ($_SESSION["resultq3"] == 'PLAIN' || $_SESSION["resultq3"] == 'DIFFSCHOOL') {
                            echo "<h4> Students are not connected</h4>";
                        } else {
                            echo "<h4> Students are connected!!!!</h4>";
                        }
                        $_SESSION["resultq3"] = NULL;
                    }
                    ?>

                </div>

            </div>

            <div id="query4">
                <?php
                $sql = "SELECT queryid,queryType,param1,param2,adminid FROM securly_school.query_history  order by queryid desc;";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo "<table  align='center' width='800'>";
                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["district_officer_id"]. " - Name: " . $row["password"]. " " . $row["password"]. "<br>";
                        echo "<tr> <td>$row[queryid]</td> <td>$row[queryType]</td> <td>$row[param1]</td> <td>$row[param2]</td> <td>$row[adminid]</td> <td> <form   method='POST' action='RequeryHandler.php'>   <input type='hidden' name='querytype' value='$row[queryType]' />  <input type='hidden' name='param1' value='$row[param1]'/>  <input type='hidden' name='param2' value='$row[param2]'/>   <input type = 'submit' /> </form> </td> </tr> <br>";
                    }
                    echo "</table>";
                }
                ?>

            </div>


        <?php } ?>

        <?php if ($flag == 0 && isset($_SESSION["clubList"]) && isset($_SESSION["studentList"]) && isset($_SESSION["resultq3"])) { ?>  

            Use proper log in 
        <?php } ?> 

    </body>
</html>