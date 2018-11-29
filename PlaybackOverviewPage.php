<?php
    //Define an easy constant for the path to the CSV file
    CONST DATABASE_PATH = "database.csv";
    //Check if the file exists and the file is larger than 0b, otherwise generate error message
    if(file_exists(DATABASE_PATH) && (filesize(DATABASE_PATH) != 0))
    {
        $ytMusicArray = file(DATABASE_PATH);
    }else{
        $errorMsg[] = "No filled database file was found.";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Youtube Mngr - Playback Overview</title>
    <meta charset="UTF-8">
    <link href="Style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
    <h1>SongOrganizer 2.0</h1>
    <?php
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
        <table>
            <tr>
                <th>Artist</th>
                <th>Song</th>
                <th>Playback</th>
            </tr>
            <?php
                /*
                 * Start a nested loop. The outer loop is responsible for selecting lines of the txt file (Per index in the array)
                 * and exploding it on the delimiters to gather the data.
                 * The inner loop is responsible for the printing of the data itself.
                 * The outer loop starts at index 1 as index 0 is the CSV header.
                 */
                for($y = 1; $y < count($ytMusicArray); $y++)
                {
                    //Explode the data on the delimiter
                    $song = explode(";", $ytMusicArray[$y]);
                    echo "<tr>";
                        //Loop the exploded data in $song
                        for($x = 0; $x < count($song); $x++)
                        {
                            echo "<td>";
                            /* If we are at index 2, print the playbackpage link with the index of the song as GET param
                             * Else, just print the data
                             */
                            if($x == 2)
                            {
                                echo "<a href='PlaybackPage.php?id=". $y . "'>Play song</a>";
                            }else{
                                echo $song[$x];
                            }
                            echo "</td>";
                        }
                    echo "</tr>";
                }
            ?>

        </table>
    </section>

</div>
</body>
</html>