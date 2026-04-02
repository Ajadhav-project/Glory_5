<?php 
session_start();
include 'config.php';
include 'products.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glory_5 - Premium Clothing Store</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- [SAME HTML STRUCTURE AS BEFORE - NO CHANGES] -->
    <!-- Header, Hero, Products, Modals - Copy from previous index.php -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <h2><i class="fas fa-crown"></i> Glory_5</h2>
            </div>
            <nav class="nav">
                <a href="#home">Home</a>
                <a href="#products">Products</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="cart-icon">
                <i class="fas fa-shopping-cart" id="cartIcon"></i>
                <span class="cart-count" id="cartCount">0</span>
            </div>
            <div class="hamburger">
                <span></span><span></span><span></span>
            </div>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Premium Streetwear Collection</h1>
            <p>Discover the latest trends in fashion</p>
            <button class="cta-btn">Shop Now</button>
        </div>
    </section>

    <section id="products" class="products-section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="products-grid" id="productsGrid">
                <?php foreach($products as $product): ?>
                <div class="product-card" data-id="<?php echo $product['id']; ?>">
                    <div class="product-image">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <div class="product-overlay">
                            <button class="btn-quick-view" onclick="quickView(<?php echo $product['id']; ?>)">
                                <i class="fas fa-eye"></i> Quick View
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <p class="price">$<?php echo $product['price']; ?></p>
                        <div class="product-actions">
                            <button class="btn-add-cart cool-btn" onclick="addToCart(<?php echo $product['id']; ?>)">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="btn-buy-now cool-btn" onclick="buyNow(<?php echo $product['id']; ?>)">
                                <i class="fas fa-bolt"></i> Buy Now
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Cart Modal -->
    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Shopping Cart</h3>
                <span class="close" onclick="closeCart()">&times;</span>
            </div>
            <div class="cart-items" id="cartItems"></div>
            <div class="cart-total">
                <h4>Total: $<span id="cartTotal">0</span></h4>
                <button class="btn-checkout cool-btn">Checkout</button>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal" id="quickViewModal">
        <div class="modal-content quick-view">
            <div class="modal-header">
                <h3 id="quickViewTitle"></h3>
                <span class="close" onclick="closeQuickView()">&times;</span>
            </div>
            <div class="quick-view-content" id="quickViewContent"></div>
        </div>
    </div>
<!-- Add this BEFORE closing </body> tag in index.php -->

<!-- 🔥 COOL FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Brand Section -->
            <div class="footer-brand">
                <h3><i class="fas fa-crown"></i> Glory_5</h3>
                <p>Premium streetwear for the future. Engineered with cutting-edge design and cosmic vibes.</p>
                <div class="social-links">
                    <a href="#" class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="social-btn" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-btn" title="Discord"><i class="fab fa-discord"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="footer-links">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Hoodies</a></li>
                    <li><a href="#">T-Shirts</a></li>
                    <li><a href="#">Pants</a></li>
                    <li><a href="#">Jackets</a></li>
                    <li><a href="#">Shoes</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="footer-newsletter">
                <h4>Stay Cosmic</h4>
                <p>Get latest drops & exclusive offers</p>
                <div class="newsletter-form">
                    <input type="email" placeholder="Enter your email" class="newsletter-input">
                    <button class="cool-btn newsletter-btn">Subscribe</button>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2024 Glory_5. All rights cosmic. Made with <i class="fas fa-heart" style="color: #ff6b9d;"></i> in the future.</p>
                <div class="footer-payments">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-paypal"></i>
                    <i class="fab fa-cc-amex"></i>
                </div>
            </div>
        </div>
    </div>
</footer>
    <script src="script.js"></script>
</body>
</html>