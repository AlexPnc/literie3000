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

if(isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $db->query("DELETE FROM matelas WHERE id=$id");
}
?>

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
                        <p><?= $matela["marque"] ?></p>
                        <p>Dimensions :<?= $matela["dimension"] ?></p>
                    </div>
                    <div class="item__trait"></div>
                    <div class="item__price">
                        <p class="item__price--normal"><?= $matela["price"] ?> €</p>
                        <p class="item__price--promo"><?= $matela["price"] - $matela["promo"] ?> €</p>
                    </div>
                    <a id="erase1" class="item__erase" href="index.php?supprimer=<?=$matela['id'] ?>">Supprimer</a>
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