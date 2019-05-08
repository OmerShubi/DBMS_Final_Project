<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Premier Pro Analytics | Insert</title>
</head>
<body style="text-align:center">
<h2 style="font-size:20px;color:white">Another game played? Add it here!</h2>
<?php
    include 'db_connection.php';
    $conn = OpenCon();
?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="text-align: center">
    Home Team:<select name="Home">
        <option value="">Choose home team</option>
        <?php
            $sql = "SELECT * FROM PremierLeague";
            $result = sqlsrv_query($conn, $sql);
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
            {
                echo "<option value=".$row['Home'].">".addslashes($row['Home'])."</option>";
            }
        ?>
    </select><br>
    Away Team:<select name="Away">
        <option value="">Choose away team</option>
        <?php
        $sql = "SELECT * FROM PremierLeague";
        $result = sqlsrv_query($conn, $sql);
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value=".$row['Away'].">".addslashes($row['Away'])."</option>";
        }
        ?>
    </select>

    <table id="insertion_table">
        <tr>
            <td>Result:</td>
        </tr>
        <tr>
            <td><input name="result" type="radio" value="H"><label for="H">H</label><br>
                <input name="result" type="radio" value="D"><label for="D">D</label><br>
                <input name="result" type="radio" value="A"><label for="A">A</label></td>
        </tr>
        <tr>
            <td><label for="home_goals">Home Goals</label></td>
            <td><input name="home_goals" type="range" step="1" min="0" max="10"></td>
        </tr>
        <tr>
            <td><label for="Away Goals">Away Goals</label></td>
            <td><input name="away_goals" type="range" step="1" min="0" max="10"></td>
        </tr>
        <tr>
            <td><label for="season">Season*</label></td>
            <td><input name="season" type="text" size="24" required></td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="notes" Rows="5" cols="37">Write here a special note</textarea></td>
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

        // Insert data into PremierLeague table
        $sql = "INSERT INTO PremierLeague (id, Home, Away, notes, home_goals, away_goals, result, season) VALUES
    ('".addslashes($id)."','".addslashes($_POST['Home'])."','".addslashes($_POST['Away'])."'
    ,'".addslashes($_POST['notes'])."','".addslashes($_POST['home_goals'])."','".addslashes($_POST['away_goals'])."'
    ,'".addslashes($_POST['result'])."','".addslashes($_POST['season'])."');";
        //echo $sql."<br>"; //debug
        $result = sqlsrv_query($conn, $sql);
        // In case of failure
        if (!$result) {
            die("Couldn't add the game specified.<br>");
        }
    }
    ?>
</body>
</html>
