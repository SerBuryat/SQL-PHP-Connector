<?php
require "vendor/autoload.php";
use App\Connection as Connection;
use App\DB as DB;

    $newsLimit = 3;
    $newsOffset = 0;

    if(isset($_GET['page'])) {
        $newsOffset = intval($_GET['page']) * $newsLimit;
    } else {
        $newsOffset = 0;
    }

    try {
        $connection = Connection::getConnection()->connect();
        $db = new DB(Connection::getConnection());

        $newsArray = $db->getTableRowsByRange('news',$newsLimit,$newsOffset);

        $pagesCount = $db->getTableRowsCount('news') / $newsLimit;
    } catch (PDOException | Exception $e) {
        echo $e->getMessage();
    }
?>


<!-- News Page -->
<div>
    <h1>Новости</h1>
    <hr>
    <table>
        <tbody>
        <?php foreach ($newsArray as $news) : ?>
            <tr>
                <td><?php echo htmlspecialchars_decode($news['id'].'.') ?></td>
                <td><a href=<?php echo "view.php?id=".$news['id']; ?>><?php echo htmlspecialchars_decode($news['title'])?></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<hr>

<!-- Pagination -->
<div>
    <?php for ($i = 0; $i < $pagesCount; $i++) :?>
        <button> <a href=<?php echo "news.php?page=".$i; ?>> <span> <?php echo $i+1?> </span> </a> </button>
    <?php endfor;?>
</div>
