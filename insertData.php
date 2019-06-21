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
                <td><label for="fullName">Full Name</label></td>
                <td><label>
                        <input name="fullName" type="text" size="24" placeholder="Your name here">
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
            // Insert data into database
            $sql = "INSERT INTO Hiker (ID, fullName, originCountry, Smoker, Fitness) VALUES
                   (
                    '".addslashes($_POST['ID'])."',
                    '".addslashes($_POST['fullName'])."',
                    '".addslashes($_POST['originCountry'])."',
                    '".addslashes($_POST['Smoker'])."',
                    '".addslashes($_POST['Fitness'])."'
                    );";

            $sql_result = sqlsrv_query($conn, $sql);

            // In case of failure
            if (!$sql_result) {
                die("<h3 style='color:darkred;'>UPLOAD FAILED<br>(Full Name & Country Max 20 Characters)</h3>");
            }
            else{
                echo "<H3 style='color: darkgreen'>Hiker Added</H3>";
            }
        }
    /* Close the connection. */
    sqlsrv_close( $conn);
    ?>
</body>
</html>
