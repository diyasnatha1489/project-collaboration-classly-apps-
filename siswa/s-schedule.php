<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/s-schedule.css">
</head>
<body>
    <div class="att-container">
        <div class="option-button">
            <a href="siswa.php?page=attd&section=today">Today</a>
            <a href="siswa.php?page=attd&section=all">All</a>
        </div> 
        <div class="att-section">
            <?php
                if(isset($_GET["section"])){
                    $page = $_GET["section"];
                    switch($page){
                        case "today":
                            include "option/today.php";
                            break;
                        case "all":
                            include "option/all.php";
                            break;
                    }
                }
            ?>
        </div> 
    </div>
</body>
</html>