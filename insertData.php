<html>
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
            <td>Home Goals</td>
            <td><input name="home_goals" type="range" step="1" min="0" max="10"></td>
        </tr>
        <tr>
            <td>Away Goals</td>
            <td><input name="away_goals" type="range" step="1" min="0" max="10"></td>
        </tr>
        <tr>
            <td>Season*</td>
            <td><input name="season" type="text" size="20" required></td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="suggestions" Rows="5" cols="30">Write here a special note</textarea></td>
        </tr>
        <tr>
            <td><input name="submit" type="submit" value="Add Result"></td>
            <td><input name="submit" type="reset" value="Reset Page"></td>
        </tr>
    </table>
</body>
</html>
