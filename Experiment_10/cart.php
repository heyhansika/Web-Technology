<?php
// 1. THE BRAIN: This part MUST be at the very top
require_once 'CartManager.php';
$cartManager = new CartManager();

// Handle removal if someone clicks 'Remove'
if (isset($_GET['remove'])) {
    $cartManager->removeItem($_GET['remove']);
    header("Location: cart.php");
    exit();
}

$items = $cartManager->getCart();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Dashboard | Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2 style="margin:0; color:var(--primary);">NexGen Store</h2>
    <a href="index.php" style="color:white; text-decoration:none; font-weight:600;">← Continue Shopping</a>
</header>

<div class="cart-container">
    <h1>🛒 Your Session Cart</h1>
    
    <?php if (empty($items)): ?>
        <div style="padding: 40px; text-align: center; color: #94a3b8;">
            <p>Your session is empty. Start adding some tech!</p>
            <a href="index.php" style="color:var(--primary); text-decoration:none;">Go to Products</a>
        </div>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $id => $data): ?>
                <tr>
                    <td>
                        <div style="font-weight: 600; font-size: 1.1rem;"><?= htmlspecialchars($data['name']) ?></div>
                    </td>
                    <td>$<?= number_format($data['price'], 2) ?></td>
                    <td style="text-align: right;">
                        <a href="cart.php?remove=<?= $id ?>" class="remove-btn">Remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-section">
            <span style="color: #94a3b8; font-size: 0.9rem;">GRAND TOTAL</span>
            <div class="grand-total">$<?= number_format($cartManager->getGrandTotal(), 2) ?></div>
            
            <div class="action-links" style="margin-top: 30px;">
                <a href="clear.php" class="clear-link" style="font-weight:bold;">Empty Entire Session</a>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>