// PATH: d8/set-c/option4.2-shopping-cart/js/solution.js
// SOLUTION: Simplified shopping cart (products in HTML, with tax calculation)

// Cart array - stores {name, price, image}
var cart = [];

/* exported addToCart, removeFromCart */
// Add item to cart
function addToCart(name, price, image) {
  cart.push({ name: name, price: price, image: image });
  renderCart();
}

// Remove item from cart
function removeFromCart(index) {
  cart.splice(index, 1);
  renderCart();
}

// Render cart
function renderCart() {
  var cartItems = document.getElementById('cartItems');
  var cartSummary = document.getElementById('cartSummary');
  var cartBadge = document.getElementById('cartBadge');
  var emptyMessage = document.getElementById('emptyMessage');

  // Update badge
  cartBadge.textContent = cart.length;

  // Clear old items
  var oldItems = cartItems.querySelectorAll('.cart-item');
  for (var i = 0; i < oldItems.length; i++) {
    oldItems[i].remove();
  }

  // Empty cart
  if (cart.length === 0) {
    emptyMessage.style.display = 'block';
    cartSummary.style.display = 'none';
    return;
  }

  // Hide empty message
  emptyMessage.style.display = 'none';

  // Build cart items
  var html = '';
  var subtotal = 0;

  for (var j = 0; j < cart.length; j++) {
    html += '<div class="cart-item">';
    html += '<div class="cart-item-icon">' + cart[j].image + '</div>';
    html += '<div class="cart-item-details">';
    html += '<div class="cart-item-name">' + cart[j].name + '</div>';
    html +=
      '<div class="cart-item-price">£' + cart[j].price.toFixed(2) + '</div>';
    html += '</div>';
    html +=
      '<button class="remove-btn" onclick="removeFromCart(' +
      j +
      ')">Remove</button>';
    html += '</div>';

    subtotal += cart[j].price;
  }

  // Add items to cart
  cartItems.insertAdjacentHTML('beforeend', html);

  // Calculate tax and total
  var tax = subtotal * 0.2;
  var total = subtotal + tax;

  // Update summary
  document.getElementById('subtotal').textContent = '£' + subtotal.toFixed(2);
  document.getElementById('tax').textContent = '£' + tax.toFixed(2);
  document.getElementById('total').textContent = '£' + total.toFixed(2);

  cartSummary.style.display = 'block';
}
