document.addEventListener('DOMContentLoaded', function() {
   const userNav = document.getElementById('userNav');

   const addToCartButtons = document.querySelectorAll('.addToCart');
   const cartButton = document.getElementById('cartButton');
   const cart = document.getElementById('cart');
   const cartItems = document.getElementById('cartItems');
   const totalPrice = document.getElementById('totalPrice');
   const clearButton = document.createElement('button');
   const checkoutButton = document.createElement('button');

   clearButton.innerText = 'Очистить корзину';
   clearButton.classList.add('clearButton');
   cart.appendChild(clearButton);

   checkoutButton.innerText = 'Сделать заказ';
   checkoutButton.classList.add('checkoutButton');
   cart.appendChild(checkoutButton);

   cartButton.classList.add('right-aligned');
   
   cartButton.addEventListener('click', function() {
       cart.style.display = cart.style.display === 'none' ? 'block' : 'none';
   });

   addToCartButtons.forEach(function(button) {
       button.addEventListener('click', function() {
           const item = this.parentNode;
           const itemName = item.querySelector('h3').innerText;
           const itemPrice = item.querySelector('p').innerText.split(':')[1].trim();
           addItemToCart(itemName, itemPrice);
       });
   });

   function addItemToCart(name, price) {
       const li = document.createElement('li');
       const deleteButton = document.createElement('button');
       deleteButton.innerText = '✕';
       deleteButton.addEventListener('click', function() {
           cartItems.removeChild(li);
           const total = calculateTotal();
           totalPrice.innerText = `Общая стоимость: ₽${calculateTotal()}`;
       });
       li.innerText = `${name} - ${price}`;
       li.appendChild(deleteButton);
       cartItems.appendChild(li);
       const total = calculateTotal();
       totalPrice.innerText = `Общая стоимость: ₽${calculateTotal()}`;
   }

   clearButton.addEventListener('click', function() {
       alert('Ваша корзина очищена. Может... Вы все-таки передумаете и закажите у нас? :-) Обещаем, что вы останетесь довольны!');
       cartItems.innerHTML = '';
       totalPrice.innerText = 'Общая стоимость: ₽0.00';
   });

   checkoutButton.addEventListener('click', function() {
       alert('Ваш заказ успешно оформлен! Спасибо за покупку!');
       cartItems.innerHTML = '';
       totalPrice.innerText = 'Общая стоимость: ₽0.00';
   });

   function calculateTotal() {
       const cartItems = document.querySelectorAll('#cartItems li');
       let total = 0;
       cartItems.forEach(function(item) {
           const price = parseFloat(item.innerText.split('-')[1].trim());
           total += price;
       });
       return total.toFixed(2);
   }
});

