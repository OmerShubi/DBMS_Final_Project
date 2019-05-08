<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics | Insert</title>
</head>
<body style="text-align:center">

    <h2 style="font-size:20px;color:white">
        Another game played? Add it here!
    </h2>

    <?php
        include 'db_connection.php';
        $conn = OpenCon(); // Connect to the database
    ?>

<!--    Data Insertion Form   -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <table class="insertion_table">
            <tr>
                <td><label for="Home">Home Team:</label></td>
                <td><select name="Home">
                    <option value="">Choose home team</option>
                    <?php
                        // Dynamically display Teams in dropdown list
                        $sql = "SELECT Home FROM PremierLeague";
                        $result = sqlsrv_query($conn, $sql);
                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                        {
                            echo "<option value=".$row['Home'].">".addslashes($row['Home'])."</option>";
                        }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td><label for="Away">Away Team:</label></td>
                <td><select name="Away">
                    <option value="">Choose away team</option>
                    <?php
                    // Dynamically display Teams in dropdown list
                        $sql = "SELECT Away FROM PremierLeague";
                        $result = sqlsrv_query($conn, $sql);
                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                        {
                            echo "<option value=".$row['Away'].">".addslashes($row['Away'])."</option>";
                        }
                    ?>
                    </select></td>
            </tr>
            <tr>
                <td><label for="result">Result:</label></td>
            </tr>
            <tr>
                <td><input name="result" type="radio" value="H"><label for="H">H</label><br>
                    <input name="result" type="radio" value="D"><label for="D">D</label><br>
                    <input name="result" type="radio" value="A"><label for="A">A</label></td>
            </tr>
            <tr style="padding-bottom: 5px">
                <td><label for="home_goals">Home Goals</label></td>
                <td>0<input name="home_goals" type="range" step="1" min="0" max="10">10</td>
            </tr>
            <tr style="padding-bottom: 5px">
                <td><label for="away Goals">Away Goals</label></td>
                <td>0<input name="away_goals" type="range" step="1" min="0" max="10">10</td>
            </tr>
            <tr style="padding-bottom: 5px">
                <td><label for="season">Season*</label></td>
                <td><input name="season" type="text" size="24" required></td>
            </tr>
            <tr style="padding-bottom: 5px">
                <td colspan="2"><textarea name="notes" Rows="5" cols="36" placeholder="Write here a special note"></textarea></td>
            </tr>
            <tr>
                <td><input name="submit" type="submit" value="Add Result"></td>
                <td><input name="reset" type="reset" value="Reset Page"></td>
            </tr>
        </table>
    </form>

    <?php
        if (isset($_POST["submit"]))
        {
            // Get last ID, increment by one and set as new ID
            $sql = "SELECT max(id) newID FROM PremierLeague";
            $IDtable = sqlsrv_query($conn, $sql);
            $row = sqlsrv_fetch_array($IDtable, SQLSRV_FETCH_ASSOC);
            $id = $row['newID'] + 1;

            // Verify goals are of type
            $sql = "INSERT INTO PremierLeague (id, Home, Away, notes, home_goals, away_goals, result, season) VALUES
                   ('".addslashes($id)."','".addslashes($_POST['Home'])."','".addslashes($_POST['Away'])."'
                   ,'".addslashes($_POST['notes'])."','".addslashes($_POST['home_goals'])."','".addslashes($_POST['away_goals'])."'
                   ,'".addslashes($_POST['result'])."','".addslashes($_POST['season'])."');";

            $result = sqlsrv_query($conn, $sql);

            // In case of failure
            if (!$result) {
                die("<h3 style='color:darkred;'>UPLOAD FAILED</h3>");
            }
            else{
                echo "<H3 style='color: darkgreen'>MATCH ADDED</H3>";
            }
        }
    ?>
</body>
</html>
