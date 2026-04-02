<?php
include 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'add':
            $product_id = (int)$_POST['product_id'];
            $quantity = max(1, (int)($_POST['quantity'] ?? 1));
            
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = ['quantity' => 0, 'product_id' => $product_id];
            }
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            break;

        case 'update':
            $product_id = (int)$_POST['product_id'];
            $quantity = max(0, (int)$_POST['quantity']);
            
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$product_id]);
            } else {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
            }
            break;

        case 'remove':
            $product_id = (int)$_POST['product_id'];
            unset($_SESSION['cart'][$product_id]);
            break;

        case 'clear':
            $_SESSION['cart'] = [];
            break;
    }
    
    echo json_encode([
        'success' => true, 
        'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))
    ]);
    exit;
}

// GET cart summary
$cart_items = [];
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $product = array_filter($GLOBALS['products'], function($p) use ($item) {
            return $p['id'] == $item['product_id'];
        });
        $product = reset($product);
        
        if ($product) {
            $cart_items[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $item['quantity'],
                'subtotal' => $product['price'] * $item['quantity']
            ];
            $total += $product['price'] * $item['quantity'];
        }
    }
}

echo json_encode([
    'items' => $cart_items,
    'total' => number_format($total, 2),
    'count' => count($cart_items),
    'session_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))
]);
?>