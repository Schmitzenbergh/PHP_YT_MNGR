<?php
    CONST DATABASE_PATH = "database.csv";
    if(file_exists(DATABASE_PATH) && (filesize(DATABASE_PATH) != 0))
    {
        $ytMusicArray = file(DATABASE_PATH);
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
    <table>
        <?php
            for($y = 0; $y < count($ytMusicArray); $y++)
            {
                $song = explode(";", $ytMusicArray[$y]);
                echo "<tr>";
                    for($x = 0; $x < count($song); $x++)
                    {
                        echo "<td>";
                        if($x >=2 && $y != 0)
                        {
                            echo "<a href='PlaybackPage.php?id=". $y . "'>&vrtri;</a>";

                        }else{
                            echo $song[$x];
                        }
                        echo "</td>";


                    }
                echo "</tr>";
            }
        ?>

    </table>

</div>
</body>
</html>