<?php
    CONST DATABASE_PATH = "database.csv";
    if(isset($_POST["submit"])){
        $data[] = filter_var($_POST["artistInput"], FILTER_SANITIZE_STRING);
        $data[] = filter_var($_POST["songTitleInput"], FILTER_SANITIZE_STRING);
        $data[] = filter_var($_POST["idInput"], FILTER_SANITIZE_URL);

        if(file_exists(DATABASE_PATH))
        {
            $handle = fopen(DATABASE_PATH,"a");
            if(fwrite($handle, implode(";", $data) . "\n")) {
                echo "succes";
                fclose($handle);
            }
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
    <?php require_once("Menu_Inc.html");?>
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

