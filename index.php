<?php
$db = new PDO("mysql:host=localhost;dbname=literie3000", "root", "");

$length = 0;
$limit = 5;

$page = isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"] : 1;

$start = isset($_GET["page"]) && !empty($_GET["page"]) ? $limit * ($_GET["page"] - 1) : 0;

$query = $db->query("SELECT *
FROM matelas
LIMIT " . $start . ", " . $limit . "");

$matelas = $query->fetchAll();

$query = $db->query("SELECT COUNT(*) FROM matelas");
$result = $query->fetch();
if ($result) {
    $length = $result[0];
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Literie3000</title>

    <link rel="stylesheet" id="typekit-css" href="https://use.typekit.net/oek3jfu.css?ver=1.0.4" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    include('templates/header.php');
    ?>

    <main>
        <div class="home">
            <div class="home__items">
                <?php
                foreach ($matelas as $matela) {

                ?>
                    <div class="home__item">

                        <img src="<?= $matela["image"] ?>" alt="">
                        <div class="item__details">
                            <h3>
                                <?= $matela["name"] ?>
                            </h3>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
            if ($length > $limit) {
                $pages = ceil($length / $limit);
            ?>
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $pages; $i++) {
                    ?>
                        <li class="pagination__item <?= $i == $page ? "active" : "" ?>">
                            <a rel="nofollow" href="index.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            }
            ?>
        </div>
    </main>

    <?php
    include('templates/footer.php');
    ?>