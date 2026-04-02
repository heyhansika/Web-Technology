<?php
class CartManager {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addToCart($id, $name, $price, $img) {
        if (!isset($_SESSION['user_cart'])) {
            $_SESSION['user_cart'] = [];
        }
        $_SESSION['user_cart'][$id] = [
            'name' => $name,
            'price' => (float)$price,
            'img' => $img
        ];
    }

    public function removeItem($id) {
        if (isset($_SESSION['user_cart'][$id])) {
            unset($_SESSION['user_cart'][$id]);
        }
    }

    public function getCart() {
        return $_SESSION['user_cart'] ?? [];
    }

    public function getGrandTotal() {
        $total = 0;
        foreach ($this->getCart() as $item) {
            $total += $item['price'];
        }
        return $total;
    }

    public function setCookieNotification($name) {
        setcookie("last_added", $name, time() + 60, "/");
    }
}
?>