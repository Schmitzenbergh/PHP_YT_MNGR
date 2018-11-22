<?php
    //Define an easy constant for the path to the CSV file
    CONST DATABASE_PATH = "database.csv";
    //Check if "submit" has been pressed
    if(isset($_POST["submit"])){
        //Check for empty values, otherwise generate an error message
        if(!empty($_POST["artistInput"]) && !empty($_POST["songTitleInput"]) && !empty($_POST["idInput"])) {
            /*
             * Filter the data with the PHP function "filter_var()" and add it to an array
             * [0]Artist; [1]Song; [2]PlaybackId
             * More info: http://php.net/manual/en/function.filter-var.php
             */
            $data[] = filter_var($_POST["artistInput"], FILTER_SANITIZE_STRING);
            $data[] = filter_var($_POST["songTitleInput"], FILTER_SANITIZE_STRING);
            $data[] = filter_var($_POST["idInput"], FILTER_SANITIZE_URL);

            //Check if the file exists, otherwise generate error message
            if (file_exists(DATABASE_PATH)) {
                //Open a file handle for use with "fwrite()"
                $handle = fopen(DATABASE_PATH, "a");

                /*
                 * Write the file with the information in the $data[] array
                 * By using implode on the $data[] array, we can easily create the CSV file format
                 * Do not forget the "\n" at the end to create a newline (Note: these are not visible in plain Windows notepad, use notepad++ or similar to see them)
                 * If writing fails, generate an error message
                 */
                if (fwrite($handle, implode(";", $data) . "\n")) {
                    echo "success";
                    fclose($handle);
                } else {
                    $errorMsg[] = "Could not write to file.";
                }

            } else {
                $errorMsg[] = "No database file was found.";
            }
        }else{
            $errorMsg[] = "Not all fields are filled in.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Youtube Mngr - Add Songs</title>
    <meta charset="UTF-8">
    <link href="Style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
    <h1>Add a new song</h1>
    <?php
        //Import the data in "Menu_Inc.html", this data is required (As in, not found will give an error)
        require_once("Menu_Inc.html");

        //Print the error messages if there are any
        if(isset($errorMsg)) {
            foreach ($errorMsg as $msg)
            {
                echo "<p class='error'>" . $msg . "</p>";
            }
        }
    ?>
    <section id="overview">
        <form action="AdminPage.php" method="post">
            <ul>
                <li><label for="artistInput">Artist:</label></li>
                <li><label for="songTitleInput">Song Title:</label></li>
                <li><label for="idInput">Youtube ID:</label></li>

            </ul>
            <ul>
                <li><input type="text" id="artistInput" name="artistInput" placeholder="Artist..."></li>
                <li><input type="text" id="songTitleInput" name="songTitleInput" placeholder="Song Title..."></li>
                <li><input type="text" id="idInput" name="idInput" placeholder="Youtube ID..."></li>
                <input type="submit" name="submit" value="Add Song">
            </ul>
        </form>
    </section>

</div>
</body>

