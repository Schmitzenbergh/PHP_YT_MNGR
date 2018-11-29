<?php
    //Define an easy constant for the path to the CSV file
    CONST DATABASE_PATH = "database.csv";

    //Define default values for artis, title and the complete iframe
    $artist = "unknown";
    $title = "unknown";
    $ytIframe = "music not found";

    //Check if get["id"] is set
    if(isset($_GET["id"]))
    {
        /*
         * Filter the data with the PHP function "filter_var()" and add it to a variable
         * In this case, we filter to only let int's pass through
         * More info: http://php.net/manual/en/function.filter-var.php
         */
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

        //Check if the id is > 0 as index 0 is the header of our CSV file
        if ($id >= 0)
        {
            //Check if the file exists, otherwise generate error message
            if(file_exists(DATABASE_PATH) && (filesize(DATABASE_PATH) != 0))
            {
                //Open the file and read it into an array (every line is an index of the array)
                $ytMusicArray = file(DATABASE_PATH);

                /*
                 * If the provided ID is smaller than the amount of entries in the array, all is good;
                 * Otherwise show an error.
                 */
                if($id < count($ytMusicArray))
                {
                    /*
                     * Get the appropriate line from the array of music based one the passed id ($ytMusicArray[$id]).
                     * Explode the data based on the ; delimiter.
                     * Extract the 3 elements we need and append them to the correct variable.
                     */
                    $database = explode(";", $ytMusicArray[$id]);
                    $artist = $database[0];
                    $title = $database[1];
                    $pbid = $database[2];

                    //Construct the iFrame containing the Youtube player + the ID
                    $ytIframe = "<iframe src='https://www.youtube.com/embed/". $pbid ."' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";

                }else{
                    $errorMsg[] = "Provided ID is not present.";
                }
            }else{
                $errorMsg[] = "No database file found.";
            }
        }

    }


?>


<!DOCTYPE html>
<html>
<head>
    <title>Youtube Mngr - Playback</title>
    <meta charset="UTF-8">
    <link href="Style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="main">
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

            //Print the artist and title, they might still be default if the id was wrong
            echo"<h1>". $artist ." - ". $title ."</h1>";
            //Import the data in "Menu_Inc.html", this data is required (As in, not found will give an error)
            echo $ytIframe
        ?>
    </div>
</body>
</html>
