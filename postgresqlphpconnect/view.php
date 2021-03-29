<?php
    require "vendor/autoload.php";
    use App\Connection as Connection;
    use App\DB as DB;

    try {
        $connection = Connection::getConnection()->connect();
        $db = new DB(Connection::getConnection());
        $id = $_GET['id'];
        $news = $db->getTableRowById('news', $id);
    } catch (PDOException | Exception $e) {
        echo $e->getMessage();
    }

    $title = htmlspecialchars_decode($news['title']);
    $content = htmlspecialchars_decode($news['content']);
    ?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title> <?php echo $title ?> </title>
        <link rel='stylesheet' type='text/css' href='app/css/style.css'>
    </head>
    <body>
        <!-- News page -->
        <div class="page-container">
            <div class="news-container">
                <h1> <?php echo $title ?>: </h1>
                <hr>
                <p> <?php echo $content ?> </p>
                <hr>
                <!-- Back to main page -->
                <a href="news.php"> Все новости >> </a>
            </div>
        </div>
    </body>
</html>