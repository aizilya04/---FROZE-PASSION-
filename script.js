document.addEventListener('DOMContentLoaded', function() {
    const userNav = document.getElementById('userNav');
    const addToCartButtons = document.querySelectorAll('.addToCart');
    const cartButton = document.getElementById('cartButton');
    const cart = document.getElementById('cart');
    const cartItems = document.getElementById('cartItems');
    const totalPrice = document.getElementById('totalPrice');
    const clearButton = document.createElement('button');
    const checkoutButton = document.createElement('button');
    const scrollToTopButton = document.createElement('button'); // Создаем кнопку "Вернуться наверх"

    clearButton.innerText = 'Очистить корзину';
    clearButton.classList.add('clearButton');
    cart.appendChild(clearButton);

    checkoutButton.innerText = 'Сделать заказ';
    checkoutButton.classList.add('checkoutButton');
    cart.appendChild(checkoutButton);

    scrollToTopButton.innerHTML = '<span class="arrow-up"></span>'; // Добавляем стрелку в кнопку
    scrollToTopButton.classList.add('scrollToTopButton'); // Добавляем класс для стилизации
    document.body.appendChild(scrollToTopButton); // Добавляем кнопку в конец документа
    scrollToTopButton.style.display = 'none'; // Скрываем кнопку "Вернуться наверх" изначально

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

    window.addEventListener('scroll', function() {
        // Показываем кнопку "Вернуться наверх" только если пользователь прокрутил страницу вниз
        if (window.scrollY > 100) {
            scrollToTopButton.style.display = 'block';
        } else {
            scrollToTopButton.style.display = 'none';
        }
    });

    scrollToTopButton.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Плавно прокручиваем страницу вверх
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

// Скрыть кнопку "Вернуться наверх" при загрузке страницы, если пользователь находится вверху
document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopButton = document.querySelector('.scrollToTopButton');
    if (window.scrollY <= 100) {
        scrollToTopButton.style.display = 'none';
    }
});