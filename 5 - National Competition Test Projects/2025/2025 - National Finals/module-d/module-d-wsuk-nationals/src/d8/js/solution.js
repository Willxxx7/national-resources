// PATH: d8/set-c/option4.3-shopping-cart/js/solution.js
// SOLUTION: Very simple shopping cart

// Cart array - stores {name, price}
var cart = [];

/* exported addToCart, removeFromCart */
// Add item to cart
function addToCart(name, price) {
  cart.push({ name: name, price: price });
  updateCart();
}

// Remove item from cart
function removeFromCart(index) {
  cart.splice(index, 1);
  updateCart();
}

// Update cart display
function updateCart() {
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
  var total = 0;

  for (var j = 0; j < cart.length; j++) {
    html += '<div class="cart-item">';
    html += '<span class="cart-item-name">' + cart[j].name + '</span>';
    html +=
      '<span class="cart-item-price">£' + cart[j].price.toFixed(2) + '</span>';
    html +=
      '<button class="remove-btn" onclick="removeFromCart(' +
      j +
      ')">Remove</button>';
    html += '</div>';

    total += cart[j].price;
  }

  // Add items to cart
  cartItems.insertAdjacentHTML('beforeend', html);

  // Update total
  document.getElementById('total').textContent = '£' + total.toFixed(2);
  cartSummary.style.display = 'block';
}
