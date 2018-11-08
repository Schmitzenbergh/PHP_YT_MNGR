<?php
    CONST DATABASE_PATH = "database.csv";
    //Check if get is set
    if(isset($_GET["id"]))
    {
        //Filter potential bad input (EG: not a number)
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

        if ($id >= 0)
        {
            if(file_exists(DATABASE_PATH) && (filesize(DATABASE_PATH) != 0))
            {
                $database = explode(";",file(DATABASE_PATH)[$id]);
                $artist = $database[0];
                $title = $database[1];
                $pbid = $database[2];
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
            echo"<h1>". $artist ." - ". $title ."</h1>";


            echo "<iframe src='https://www.youtube.com/embed/". $pbid ."' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        ?>
    </div>
</body>
</html>