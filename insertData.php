<html>
<body>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <select name="SUPID">
        <option value="">Choose Supplier...</option>
        <?php
        $sql = "SELECT * FROM Suppliers";
        $result = sqlsrv_query($conn, $sql);
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            echo "<option value=".$row['sid'].">".addslashes($row['sname'])."</option>";
        }


        ?>
    </select>
    <h2>Part Details</h2>
    <table border="0" cellpadding="5">
        <tr>
            <td>ID</td>
            <td><input name="PID" type="text" size="10"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input name="PNAME" type="text" size="20"></td>
        </tr>
        <tr>
            <td>Color</td>
            <td><input name="COLOR" type="text" size="10"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input name="PRICE" type="text" size="5"></td>
        </tr>
        <tr>
            <td colspan="2"><br><input name="submit" type="submit" value="Send"></td>
        </tr>

    </table>
</body>
</html>
