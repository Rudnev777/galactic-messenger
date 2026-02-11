<?php
$db = new PDO("mysql:host=localhost;dbname=news;charset=utf8", "root", "misha2005");
$id = $_GET["id"];
$sql = "SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y') fmt FROM news WHERE id = ?";
$rs = $db->prepare($sql);
$rs->bindValue(1, $id, PDO::PARAM_INT);
$rs->execute();
$news = $rs->fetch();
?>

<section class="main__section--breadcrumbs"><a href="index.php" class="main__section--breadcrumbs--element">Главная</a>
    <samp class="main__section--breadcrumbs--element--active main__section--breadcrumbs--element">
        /<?= $news["title"] ?></samp>
</section>

<h1 class="main__h1--title">
    <?= $news["title"] ?>
</h1>
<section class="main__section--news">
    <section class="main__section--news--text">
        <samp class="main__section__samp--date">
            <?= $news["fmt"] ?>
        </samp>
        <h2 class="main__section__h2--announce">
            <?= $news["announce"] ?>
        </h2>
        <samp class="main__section__samp--content">
            <?= $news["content"] ?>
        </samp>
        <a href="index.php" class="main__section__a--back">←назад к новостям</a>
    </section>
    <img src="public/task/images/<?= $news["image"] ?>" alt="" class="main__section__img">
</section>