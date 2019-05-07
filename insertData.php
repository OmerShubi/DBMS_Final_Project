<html>
<body>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <select name="SUPID">
        <option value="">Choose Supplier...</option>
        <?php
            $sql = "SELECT * FROM PremierLeague";
            $result = sqlsrv_query($conn, $sql);
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
            {
                echo "<option value=".$row['sid'].">".addslashes($row['sname'])."</option>";
            }
        ?>
    </select>
    <select name="SUPID">
        <option value="">Choose Supplier...</option>
        <?php
        $sql = "SELECT * FROM PremierLeague";
        $result = sqlsrv_query($conn, $sql);
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value=".$row['sid'].">".addslashes($row['sname'])."</option>";
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
            <td><input name="season" type="text" size="50"></td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="suggestions" Rows="5" cols="70">Write your comments here</textarea></td>
        </tr>
        <tr>
            <td colspan="2"><br><input name="submit" type="submit" value="Send"></td>
        </tr>
    </table>
</body>
</html>
