<?php
require_once 'config.php';
require_once 'CartManager.php';
$cartManager = new CartManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $cartManager->addToCart($_POST['id'], $_POST['name'], $_POST['pprice'], $_POST['pimg']);
    $cartManager->setCookieNotification($_POST['name']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Advanced Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h2>NexGen Tech</h2>
    <a href="cart.php" style="color:white; text-decoration:none;">🛒 Cart (<?= count($cartManager->getCart()) ?>)</a>
</header>

<div class="grid">
    <?php foreach ($products as $p): ?>
    <div class="card">
        <img src="<?= $p['img'] ?>">
        <h3><?= $p['name'] ?></h3>
        <p>$<?= number_format($p['price'], 2) ?></p>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <input type="hidden" name="name" value="<?= $p['name'] ?>">
            <input type="hidden" name="pprice" value="<?= $p['price'] ?>">
            <input type="hidden" name="pimg" value="<?= $p['img'] ?>">
            <button type="submit" name="add" class="btn-buy">Add to Session</button>
        </form>
    </div>
    <?php endforeach; ?>
</div>

<?php if(isset($_COOKIE['last_added'])): ?>
    <div style="position:fixed; bottom:20px; right:20px; background:var(--primary); padding:15px; border-radius:8px;">
        Last item picked: <?= $_COOKIE['last_added'] ?>
    </div>
<?php endif; ?>
</body>
</html>