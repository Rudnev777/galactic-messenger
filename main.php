<?php
$db = new PDO("mysql:host=localhost;dbname=news;charset=utf8", "root", "misha2005");
$page = $_GET['page'] ?? 1;

$limit = 4;
$offset = (($page - 1) * $limit);
$rs = $db->query("SELECT count(*) total FROM news");
$row = $rs->fetch();
$total = $row['total'];
$pages = ceil($total / $limit);

$sql = "SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y') fmt FROM news ORDER BY `date` DESC LIMIT ? OFFSET ?";
$rs = $db->prepare($sql);

$rs->bindValue(1, $limit, PDO::PARAM_INT);
$rs->bindValue(2, $offset, PDO::PARAM_INT);
$rs->execute();





// $structure = $db->query("DESCRIBE news");
// echo "<h3>Структура таблицы news:</h3>";
// echo "<ul>";
// foreach ($structure as $column) {
//     echo "<li>" . $column['Field'] . " (" . $column['Type'] . ")</li>";
// }
// echo "</ul>";

?>
<?php
$sql = "SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y') fmt FROM news ORDER BY `date` DESC LIMIT ? OFFSET ?";
$rs1 = $db->prepare($sql);
$rs1->bindValue(1, $limit, PDO::PARAM_INT);
$rs1->bindValue(2, $offset, PDO::PARAM_INT);
$rs1->execute();
$main_news = $rs1->fetch();

?>
<section class="main__section--main-news"
    style="background-image: url('public/task/images/<?= $main_news['image'] ?>')">


    <h1 class="main__h1--main-news--title--new">
        <?= $main_news["title"] ?>
    </h1>
    <samp class="main__samp--main-news--announce-new">
        <?= $main_news["announce"] ?>
    </samp>
</section>
<h1>Новости</h1>
<section class="main__section--news">
    <?php
    while ($row = $rs->fetch()) {
        ?>
        <section class="main__section--new">
            <samp class="main__samp--date-new">
                <?= $row["fmt"] ?>
            </samp>
            <h2 class="main__h2--title--new">
                <?= $row["title"] ?>
            </h2>
            <samp class="main__samp--announce-new">
                <?= $row["announce"] ?>
            </samp>
            <a href="news.php?id=<?= $row["id"] ?>" class="main__a--detail--new">Подробнее→</a>
        </section>
        <?php
    }
    ?>
    <section>
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            ?>
            <a href="index.php?page=<?= $i ?>"><?= $i ?></a>
            <?php
        }
        ?>
    </section>
</section>