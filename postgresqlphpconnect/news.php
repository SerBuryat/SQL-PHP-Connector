<?php
require "vendor/autoload.php";
use App\Connection as Connection;
use App\DB as DB;

    try {
        $connection = Connection::getConnection()->connect();
        $db = new DB(Connection::getConnection());
        $newsArray = $db->getTableRows('news');
    } catch (PDOException | Exception $e) {
        echo $e->getMessage();
    }
?>


<!-- News Page -->

<div>
    <h1>Lenta.ru : News</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
        </tr>
        </thead>
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
