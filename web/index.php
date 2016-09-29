<?php

require '../vendor/autoload.php';

if (array_key_exists('sku', $_POST)) {
    $catalogue = new Db\Catalogue('/tmp/mbe-workshop');
    $product = Product::withSku(Sku::fromCode($_POST['sku']));

    $basket = new Basket();

    $basket->addProductFromCatalogue($product, $catalogue);
}

?>

<form method="post">
    <input type="text" name="sku" value="<?= $_GET['sku'] ?>" />
    <button type="submit">Add to Basket</button>
</form>

<?php if (isset($basket)): ?>

<div id="total">
    Total cost: £<span><?= $basket->totalCost() ?></span>
</div>

<?php endif ?>
