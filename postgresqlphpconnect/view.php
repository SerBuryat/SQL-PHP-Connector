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
    ?>

<!-- News page -->
<div>
    <h1> News <?php echo htmlspecialchars_decode($news['id']) ?>: </h1>
    <hr>
    <p> <?php echo htmlspecialchars_decode($news['title']) ?> </p>
    <hr>
    <a href="news.php"> Все новости >> </a>
</div>