<?/*php
    require "vendor/autoload.php";
    use App\Connection as Connection;
    use App\DB as DB;

    try {
        $connection = Connection::getConnection()->connect();
        $db = new DB(Connection::getConnection());
        $id = intval($_GET['id'][0]);
        $news = $db->getTableRowById('news', $id);
    } catch (PDOException | Exception $e) {
        echo $e->getMessage();
    }
    */?>

<div>
    <h1> <? $news['title']?>  </h1>
    <p>   </p>
</div>