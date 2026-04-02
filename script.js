// Cart functionality - Works perfectly with new theme
let cart = JSON.parse(localStorage.getItem('glory5_cart')) || [];

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cartCount').textContent = count;
    document.getElementById('cartTotal').textContent = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0).toFixed(2);
}

function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }
    
    localStorage.setItem('glory5_cart', JSON.stringify(cart));
    updateCartCount();
    showNotification('🛒 Added to cart!', 'success');
}

function buyNow(productId) {
    const product = products.find(p => p.id === productId);
    cart = [{ ...product, quantity: 1 }];
    localStorage.setItem('glory5_cart', JSON.stringify(cart));
    updateCartCount();
    showNotification('⚡ Proceeding to checkout!', 'success');
}

function showCart() {
    const cartItems = document.getElementById('cartItems');
    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div style="text-align: center; padding: 40px; color: #e0f7ff;">
                <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #00d4ff; margin-bottom: 20px;"></i>
                <p style="font-size: 1.2rem; opacity: 0.8;">Your cart is empty 😢</p>
                <button class="cool-btn" onclick="scrollToProducts()" style="margin-top: 20px; padding: 12px 30px;">
                    Start Shopping
                </button>
            </div>
        `;
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item" style="display: flex; padding: 20px 0; border-bottom: 1px solid rgba(255,255,255,0.1); align-items: center; gap: 15px;">
                <img src="${item.image}" alt="${item.name}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 15px; border: 2px solid rgba(255,255,255,0.2);">
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 8px 0; font-size: 1.1rem; color: #e0f7ff;">${item.name}</h4>
                    <p style="margin: 0 0 5px 0; color: #00d4ff; font-weight: bold; font-size: 1.1rem;">$${item.price.toFixed(2)}</p>
                    <small style="color: #a0a0ff;">Qty: ${item.quantity}</small>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; min-width: 150px;">
                    <button onclick="updateQuantity(${item.id}, -1)" style="background: linear-gradient(135deg, #ff6b9d, #c44569); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-weight: bold; cursor: pointer; transition: all 0.3s ease;" title="Decrease">-</button>
                    <span style="font-weight: bold; font-size: 1.2rem; color: #fff; min-width: 25px; text-align: center;">${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, 1)" style="background: linear-gradient(135deg, #00d4ff, #0099cc); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-weight: bold; cursor: pointer; transition: all 0.3s ease;" title="Increase">+</button>
                    <button onclick="removeFromCart(${item.id})" style="background: rgba(255,71,87,0.8); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; font-weight: bold; cursor: pointer; transition: all 0.3s ease;" title="Remove">✕</button>
                </div>
            </div>
        `).join('');
    }
    updateCartCount();
    document.getElementById('cartModal').style.display = 'block';
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            localStorage.setItem('glory5_cart', JSON.stringify(cart));
            showCart();
            updateCartCount();
        }
    }
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('glory5_cart', JSON.stringify(cart));
    showCart();
    updateCartCount();
    showNotification('🗑️ Item removed!', 'info');
}

function quickView(productId) {
    const product = products.find(p => p.id === productId);
    if (product) {
        document.getElementById('quickViewTitle').textContent = product.name;
        document.getElementById('quickViewContent').innerHTML = `
            <div style="display: flex; gap: 25px; align-items: center; padding: 20px 0;">
                <img src="${product.image}" alt="${product.name}" style="width: 220px; height: 280px; object-fit: cover; border-radius: 20px; border: 3px solid rgba(255,255,255,0.2);">
                <div style="flex: 1;">
                    <h3 style="color: #00d4ff; margin-bottom: 15px; font-size: 1.8rem;">$${product.price.toFixed(2)}</h3>
                    <p style="margin-bottom: 25px; color: #e0f7ff; line-height: 1.7; font-size: 1.1rem;">${product.description || 'Premium quality clothing with modern design and perfect fit.'}</p>
                    <div style="display: flex; gap: 15px;">
                        <button class="cool-btn" onclick="addToCart(${product.id}); closeQuickView();" style="padding: 15px 30px; font-size: 1rem;">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                        <button class="cool-btn" onclick="buyNow(${product.id}); closeQuickView();" style="padding: 15px 30px; font-size: 1rem;">
                            <i class="fas fa-bolt"></i> Buy Now
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('quickViewModal').style.display = 'block';
    }
}

// Modal controls
function closeCart() { document.getElementById('cartModal').style.display = 'none'; }
function closeQuickView() { document.getElementById('quickViewModal').style.display = 'none'; }
function scrollToProducts() { document.getElementById('products').scrollIntoView({behavior: 'smooth'}); }

// 🔥 COOL NOTIFICATION SYSTEM (New colors!)
function showNotification(message, type = 'success') {
    const colors = {
        success: '#00d4ff',
        info: '#ff6b9d',
        error: '#ff4757'
    };
    
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 120px;
        right: 20px;
        background: linear-gradient(135deg, ${colors[type]}, ${type === 'success' ? '#0099cc' : type === 'info' ? '#c44569' : '#ff3742'});
        color: white;
        padding: 18px 25px;
        border-radius: 15px;
        box-shadow: 0 15px 40px ${type === 'success' ? 'rgba(0,212,255,0.4)' : 'rgba(255,71,87,0.4)'};
        z-index: 3000;
        transform: translateX(400px);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        font-weight: 600;
        border-left: 5px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    `;
    notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-circle'}" style="margin-right: 10px;"></i>${message}`;
    document.body.appendChild(notification);
    
    setTimeout(() => notification.style.transform = 'translateX(0)', 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => document.body.removeChild(notification), 400);
    }, 3500);
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    
    document.getElementById('cartIcon').addEventListener('click', showCart);
    
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    };
    
    // Mobile hamburger
    document.querySelector('.hamburger').addEventListener('click', () => {
        document.querySelector('.nav').classList.toggle('active');
    });
    
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({behavior: 'smooth'});
        });
    });
    
    document.querySelector('.btn-checkout')?.addEventListener('click', function() {
        if (cart.length > 0) {
            showNotification('🚀 Redirecting to secure checkout...', 'success');
            setTimeout(() => alert('Demo Checkout - Payment gateway integration ready!'), 1500);
        }
    });
});