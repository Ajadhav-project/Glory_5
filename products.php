<?php
include 'config.php';

// 🔥 COOL PRODUCTS with Enhanced Data
$products = [
    [
        'id' => 1,
        'name' => 'Cyber Hoodie V2',
        'price' => 89.99,
        'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400&h=500&fit=crop',
        'category' => 'hoodies',
        'description' => 'Futuristic cyberpunk hoodie with neon stitching and premium Japanese cotton'
    ],
    [
        'id' => 2,
        'name' => 'Neon Street Tee',
        'price' => 39.99,
        'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=500&fit=crop',
        'category' => 'tshirts',
        'description' => 'Glow-in-the-dark graphic tee with holographic print technology'
    ],
    [
        'id' => 3,
        'name' => 'Tech Cargo Pants',
        'price' => 79.99,
        'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400&h=500&fit=crop',
        'category' => 'pants',
        'description' => 'Multi-pocket tactical cargo pants with water-resistant nano-tech fabric'
    ],
    [
        'id' => 4,
        'name' => 'Holo Denim Jacket',
        'price' => 129.99,
        'image' => 'https://images.unsplash.com/photo-1549844961-6090f78f8f47?w=400&h=500&fit=crop',
        'category' => 'jackets',
        'description' => 'Holographic denim jacket with laser-etched patterns and vintage wash'
    ],
    [
        'id' => 5,
        'name' => 'Phantom Sneakers',
        'price' => 149.99,
        'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=500&fit=crop',
        'category' => 'shoes',
        'description' => 'Limited edition sneakers with glow reactive soles and Italian leather'
    ],
    [
        'id' => 6,
        'name' => 'Storm Windbreaker',
        'price' => 69.99,
        'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=400&h=500&fit=crop',
        'category' => 'jackets',
        'description' => 'Ultra-light windbreaker with 360° reflectivity and packable design'
    ]
];

// Output for JavaScript
echo "<script>const products = " . json_encode($products) . ";</script>";
?>
