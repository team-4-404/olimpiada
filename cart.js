// Класс для управления корзиной
class Cart {
    constructor() {
        this.items = JSON.parse(localStorage.getItem('cart')) || [];
        this.products = []; // Хранилище всех товаров
        this.init();
    }

    async init() {
        await this.loadProducts(); // Загружаем товары при инициализации
        this.renderItems();
        this.updateTotals();
        this.setupEventListeners();
        this.updateCartBadge();
    }

    async loadProducts() {
        try {
            const response = await fetch('products.json');
            const data = await response.json();
            this.products = data.products;
        } catch (error) {
            console.error('Ошибка загрузки товаров:', error);
            this.products = [];
        }
    }

    // Получение информации о товаре по ID
    getProductById(id) {
        return this.products.find(product => product.id === id);
    }

    // Добавление товара по ID
    addItemById(productId) {
        const product = this.getProductById(productId);
        if (product) {
            this.addItem(product);
        }
    }

    // Форматирование цены
    formatPrice(price) {
        return new Intl.NumberFormat('ru-RU', {
            style: 'currency',
            currency: 'RUB',
            minimumFractionDigits: 0
        }).format(price);
    }

    // Добавление товара
    addItem(product) {
        const existingItem = this.items.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            this.items.push({ ...product, quantity: 1 });
        }
        this.saveToLocalStorage();
        this.renderItems();
        this.updateTotals();
        this.updateCartBadge();
    }

    // Удаление товара
    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.saveToLocalStorage();
        this.renderItems();
        this.updateTotals();
        this.updateCartBadge();
    }

    // Обновление количества
    updateQuantity(productId, newQuantity) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, newQuantity);
            this.saveToLocalStorage();
            this.renderItems();
            this.updateTotals();
            this.updateCartBadge();
        }
    }

    // Сохранение в localStorage
    saveToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(this.items));
    }

    // Обновление бейджа корзины
    updateCartBadge() {
        const totalItems = this.items.reduce((sum, item) => sum + item.quantity, 0);
        const badge = document.querySelector('.cart-badge');
        if (badge) {
            badge.textContent = totalItems;
            badge.style.display = totalItems > 0 ? 'block' : 'none';
        }
    }

    // Отрисовка товаров
    renderItems() {
        const cartContainer = document.getElementById('cart-items');
        if (!cartContainer) return;

        if (this.items.length === 0) {
            cartContainer.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Ваша корзина пуста</p>
                    <a href="catalog.html" class="btn btn-primary inline-block mt-4 w-auto px-6">Перейти в каталог</a>
                </div>
            `;
            return;
        }

        cartContainer.innerHTML = this.items.map(item => `
            <div class="cart-item" data-id="${item.id}">
                <img src="${item.image}" alt="${item.name}" class="product-image">
                <div class="flex-1">
                    <h3 class="font-semibold">${item.name}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">${item.description || ''}</p>
                    <div class="mt-2 flex items-center justify-between">
                        <div class="quantity-controls">
                            <button class="quantity-btn minus" aria-label="Уменьшить количество">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity px-3">${item.quantity}</span>
                            <button class="quantity-btn plus" aria-label="Увеличить количество">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="font-bold">${this.formatPrice(item.price * item.quantity)}</div>
                    </div>
                </div>
                <button class="remove-item text-red-500 hover:text-red-700" aria-label="Удалить товар">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `).join('');
    }

    // Расчет итогов
    updateTotals() {
        const subtotal = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const delivery = subtotal >= 5000 ? 0 : 500;
        const total = subtotal + delivery;

        document.getElementById('subtotal').textContent = this.formatPrice(subtotal);
        document.getElementById('delivery').textContent = this.formatPrice(delivery);
        document.getElementById('total').textContent = this.formatPrice(total);

        // Обновляем видимость секции оформления заказа
        const checkoutSection = document.querySelector('.checkout-section');
        if (checkoutSection) {
            checkoutSection.style.display = this.items.length > 0 ? 'block' : 'none';
        }
    }

    // Настройка обработчиков событий
    setupEventListeners() {
        document.addEventListener('click', (e) => {
            const cartItem = e.target.closest('.cart-item');
            if (!cartItem) return;

            const productId = parseInt(cartItem.dataset.id);

            if (e.target.closest('.minus')) {
                const item = this.items.find(item => item.id === productId);
                if (item) this.updateQuantity(productId, item.quantity - 1);
            }

            if (e.target.closest('.plus')) {
                const item = this.items.find(item => item.id === productId);
                if (item) this.updateQuantity(productId, item.quantity + 1);
            }

            if (e.target.closest('.remove-item')) {
                this.removeItem(productId);
            }
        });

        // Обработка формы заказа
        const checkoutForm = document.querySelector('.checkout-section');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Валидация формы
                const name = document.getElementById('name').value.trim();
                const phone = document.getElementById('phone').value.trim();
                const email = document.getElementById('email').value.trim();
                const address = document.getElementById('address').value.trim();

                if (!name || !phone || !email || !address) {
                    alert('Пожалуйста, заполните все поля формы');
                    return;
                }

                // Здесь можно добавить отправку заказа на сервер
                alert('Заказ успешно оформлен!');
                this.items = [];
                this.saveToLocalStorage();
                this.renderItems();
                this.updateTotals();
                this.updateCartBadge();
            });
        }
    }
}

// Инициализация корзины
document.addEventListener('DOMContentLoaded', () => {
    window.cart = new Cart();

    // Обработчик переключения темы
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
            
            // Обновляем иконку
            const icon = themeToggle.querySelector('i');
            icon.classList.toggle('fa-moon');
            icon.classList.toggle('fa-sun');
        });
    }

    // Инициализация мобильного меню
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobile-menu');
    if (burger && mobileMenu) {
        burger.addEventListener('click', () => {
            mobileMenu.classList.toggle('show');
        });
    }

    // Восстановление темы
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        const themeIcon = document.querySelector('#theme-toggle i');
        if (themeIcon) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }
    }
});