<html>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

        <input name="csv" type="file" id="csv" />
        <input type="submit" name="submit" value="submit" />

    </form>

    <?php
        if (isset($_POST["submit"])){
        // Connect to the database
            $file = $_FILES[csv][tmp_name];
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $sql="INSERT INTO PremierLeague (id, Home, Away, notes, home_goals, away_goals, result, season) VALUES 
                    ('".addslashes($data[0])."','".addslashes($data[1])."','"
                        .addslashes($data[2])."','".addslashes($data[3])."','"
                        .addslashes($data[4])."','".addslashes($data[5])."','"
                        .addslashes($data[6])."','".addslashes($data[7])."'); ";
                 sqlsrv_query($conn, $sql);
                    }
                  fclose($handle); } }
    ?>
</body>
</html>
