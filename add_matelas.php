<?php

if (!empty($_POST)) {

    $image = trim(strip_tags($_POST["image"]));
    $marque = trim(strip_tags($_POST["marque"]));
    $name = trim(strip_tags($_POST["name"]));
    $dimension = trim(strip_tags($_POST["dimension"]));
    $price = trim(strip_tags($_POST["price"]));
    $promo = trim(strip_tags($_POST["promo"]));

    $errors = [];

    if (empty($name)) {
        $errors["name"] = "Le nom du matelas est obligatoire !";
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors["image"] = "L'url de l'image est invalide !";
    }

    if (empty($errors)) {

        $dsn = "mysql:host=localhost;dbname=literie3000";
        $db = new PDO($dsn, "root", "");

        $query = $db->prepare("INSERT INTO matelas
            (image, marque, name, dimension, price, promo)
            VALUES
            (:image, :marque, :name, :dimension, :price, :promo)
        ");

        $query->bindParam(":image", $image);
        $query->bindParam(":marque", $marque);
        $query->bindParam(":name", $name);
        $query->bindParam(":dimension", $dimension);
        $query->bindParam(":price", $price, PDO::PARAM_INT);
        $query->bindParam(":promo", $promo, PDO::PARAM_INT);

        if ($query->execute()) {
            header("Location: index.php");
        };
    }
}

include("templates/header.php")
?>

<h1>Ajouter un matelas</h1>

<form action="" method="post">
    <div class="form__group">
        <label for="inputName">Nom du matelas :</label>
        <input id="inputName" name="name" type="text" value="<?= isset($name) ? $name : "" ?>">
        <?php
        if (isset($errors["name"])) {
        ?>
            <span class="form__group--error"><?= $errors["name"] ?></span>
        <?php
        }
        ?>
    </div>

    <div class="form__group">
        <label for="inputImage">Photo de la recette :</label>
        <input id="inputImage" name="image" type="text" value="<?= isset($image) ? $image : "" ?>">
        <?php
        if (isset($errors["picture"])) {
        ?>
            <span class="form__group--error"><?= $errors["picture"] ?></span>
        <?php
        }
        ?>
    </div>

    <div class="form__group">
        <label for="inputMarque">Marque :</label>
        <input id="inputMarque" name="marque" type="text" value="<?= isset($marque) ? $marque : "" ?>">
    </div>

    <div class="form__group">
        <label for="inputDimension">Dimension :</label>
        <input id="inputDimension" name="dimension" type="text" value="<?= isset($dimension) ? $dimension : "" ?>">
    </div>

    <div class="form__group">
        <label for="inputPrice">Prix :</label>
        <input id="inputPrice" name="price" type="number" value="<?= isset($price) ? $price : "" ?>">
    </div>

    <div class="form__group">
        <label for="inputPromo">Promo :</label>
        <input id="inputPromo" name="promo" type="number" value="<?= isset($promo) ? $promo : "" ?>">
    </div>


    <input class="form__button" type="submit" value="Ajouter le matelas">
</form>

<?php
include("templates/footer.php")
?>