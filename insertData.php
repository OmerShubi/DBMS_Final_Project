<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Trek Pro Analytics | Insert</title>
</head>
<body style="text-align:center">

    <h2 style="font-size:20px;color:white">
        New Hiker? Add your Info Below!
    </h2>

    <!--    Connect to the database   -->
    <?php
        include 'db_connection.php';
        $conn = OpenCon();
    ?>

    <!--    Data Insertion Form   -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <table class="insertion_table">
            <!--    ID   -->
            <tr>
                <td><label for="ID">ID*</label></td>
                <td><label>
                        <input name="ID" type="text" size="24" required placeholder="Numbers only!">
                    </label></td>
            </tr>
            <tr></tr>
            <!--    Full Name   -->
            <tr>
                <td><label for="Name">Full Name</label></td>
                <td><label>
                        <input name="Name" type="text" size="24" placeholder="Your name here">
                    </label></td>
            </tr>
            <tr></tr>

            <!--    Country   -->
            <tr>
                <td><label for="Country">Country</label></td>
                <td><label>
                        <input name="Country" type="text" size="24" placeholder="Country of Birth">
                    </label></td>
            </tr>
            <tr></tr>

            <!--    Fitness   -->
            <tr>
                <td><label for="Fitness">Fitness</label></td>
                <td>0<label>
                        <input name="Fitness" type="range" step="1" min="0" max="100">
                    </label>100</td>
            </tr>
            <tr></tr>

            <!--    Smoker   -->
            <tr>
                <td><label for="Smoker">Smoker:</label></td>
            </tr>
            <tr>
                <td>
                    <label>
                        <input name="Smoker" type="radio" value="No" checked="checked">
                    </label>
                    <label for="No">
                        No
                    </label>
                    <br>
                    <label>
                        <input name="Smoker" type="radio" value="Yes">
                    </label>
                    <label for="Yes">
                        Yes
                    </label>
                </td>
            </tr>
            <tr></tr>

            <!--    Submission & Reset Buttons   -->
            <tr>
                <td><input name="submit" type="submit" value="Add Result"></td>
                <td><input name="reset" type="reset" value="Reset Page"></td>
            </tr>
        </table>
    </form>

    <!--    Submit Data to Database   -->
    <?php
        if (isset($_POST["submit"]))
        {
            // Get last ID, increment by one and set as new ID
            $sql = "SELECT max(id) newID FROM PremierLeague";
            $IDtable = sqlsrv_query($conn, $sql);
            $row = sqlsrv_fetch_array($IDtable, SQLSRV_FETCH_ASSOC);
            $id = $row['newID'] + 1;

            // Insert data into database
            $sql = "INSERT INTO PremierLeague (id, Home, Away, notes, home_goals, away_goals, result, season) VALUES
                   ('".addslashes($id)."','".addslashes($_POST['Home'])."','".addslashes($_POST['Away'])."'
                   ,'".addslashes($_POST['notes'])."','".addslashes($_POST['home_goals'])."','".addslashes($_POST['away_goals'])."'
                   ,'".addslashes($_POST['result'])."','".addslashes($_POST['season'])."');";

            $sql_result = sqlsrv_query($conn, $sql);

            // In case of failure
            if (!$sql_result) {
                die("<h3 style='color:darkred;'>UPLOAD FAILED<br>(Season should be max 10 characters)</h3>");
            }
            else{
                echo "<H3 style='color: darkgreen'>MATCH ADDED</H3>";
            }
        }
    /* Close the connection. */
    sqlsrv_close( $conn);
    ?>
</body>
</html>
