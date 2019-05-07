<html lang="en">
<body>
<?php
    include 'db_connection.php';
    $conn = OpenCon();
?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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

    <table border="0" cellpadding="5">
        <tr>
            <td>Result:</td>
        </tr>
        <tr>
            <td><input name="result" type="radio" value="H">H<br><input name="result" type="radio" value="D">D<br><input name="result" type="radio" value="A">A</td>
        </tr>
        <tr>
            <td>Home Goals</td><td><input name="home_goals" type="range" step="1" min="0" max="10"></td>
        </tr>
        <tr>
            <td>Away Goals</td><td><input name="away_goals" type="range" step="1" min="0" max="10"></td>
        </tr>
        <tr>
            <td>Season*</td><td><input name="season" type="text" size="24" required></td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="notes" Rows="5" cols="37">Write here a special note</textarea></td>
        </tr>
        <tr>
            <td><input name="submit" type="submit" value="Add Result"></td>
            <td><input name="reset" type="reset" value="Reset Page"></td>
        </tr>
    </table>

    <?php
    if (isset($_POST["submit"]))
    {
        $sql = "SELECT max(id) FROM PremierLeague";
        $id = sqlsrv_query($conn, $sql);
        $id = $id + 1;
        echo $id."<br>";
        // Insert data into PremierLeague table
        $sql = "INSERT INTO PremierLeague (id, Home, Away, notes, home_goals, away_goals, result, season) VALUES
    ('".addslashes($_POST[$id])."','".addslashes($_POST['Home'])."','".addslashes($_POST['Away'])."'
    ,'".addslashes($_POST['notes'])."','".addslashes($_POST['home_goals'])."','".addslashes($_POST['away_goals'])."'
    ,'".addslashes($_POST['result'])."','".addslashes($_POST['season'])."');";
        echo $sql."<br>"; //debug
        $result = sqlsrv_query($conn, $sql);
        // In case of failure
        if (!$result) {
            die("Couldn't add the game specified.<br>");
        }
    }
    ?>
</body>
</html>
