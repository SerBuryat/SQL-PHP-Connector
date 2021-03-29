<?php
require "vendor/autoload.php";
use App\Connection as Connection;
use App\DB as DB;

    $limit = 5;
    $offset = 0;

    if(isset($_GET['page'])) {
        $page = intval($_GET['page']);
        $offset = ($page - 1) * $limit;
    } else {
        $offset = 0;
    }

    try {
        $connection = Connection::getConnection()->connect();
        $db = new DB(Connection::getConnection());

        $newsArray = $db->getTableRowsByParameters('news',$limit,$offset, 'idate');

        $pagesCount = $db->getTableRowsCount('news') / $limit;
    } catch (PDOException | Exception $e) {
        echo $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title> Новости </title>
    <link rel='stylesheet' type='text/css' href='app/css/style.css'>
    <script src="app/js/main.js"></script>
</head>
<body>
<!-- News Page -->
<div class="page-container">
    <div class="news-container">
        <h1>Новости</h1>
        <hr>
        <?php foreach ($newsArray as $news) : ?>
            <div class="one-news-container">
                <?php
                $date = htmlspecialchars_decode(gmdate("d.m.Y", $news['idate']));
                $title = htmlspecialchars_decode($news['title']);
                $id = $news['id'];
                $announce = htmlspecialchars_decode($news['announce']);
                ?>
                <div class="one-news-container-top">
                    <span class="date"> <?php echo $date ?> </span>
                    <span class="title"> <a href=<?php echo "view.php?id=".$id; ?>><?php echo $title?></a></span>
                </div class="one-news-container-bottom">
                <div> <?php echo $announce ?> </div>
            </div>
        <?php endforeach; ?>

        <hr>
        <!-- Pagination -->
        <div class="news-pagination">
            <div>
                <b>Страницы:</b>
            </div>
            <div class="pagination-buttons">
                <?php for ($i = 0; $i < $pagesCount; $i++) :?>
                    <a class="pagination-button <?php echo ($page-1 == $i) ? ' current-pagination-button' : ' ' ?> " href= <?php echo "news.php?page=".$i+1; ?> > <?php echo $i+1?> </a>
                <?php endfor;?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
