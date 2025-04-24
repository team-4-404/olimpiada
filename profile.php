<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetZone - Личный кабинет</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Общие стили и переменные */
        :root {
            --primary-light: #3b82f6;
            --text-dark-highlight: #e5e7eb; /* Более светлый текст для темной темы */
            --text-muted-dark: #9ca3af;
            --primary-dark: #2563eb;
            --secondary-light: #10b981;
            --secondary-dark: #059669;
            --text-light: #1f2937;
            --text-dark: #f3f4f6;
            --bg-light: #f9fafb;
            --bg-dark: #111827;
            --gray-light: #e5e7eb;
            --gray-dark: #374151;
            --white: #ffffff;
            --black: #000000;
            --max-width: 1200px;
            --border-radius: 0.5rem;
            --transition: all 0.3s ease;
        }

        /* Базовые стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-light);
            background-color: var(--bg-light);
            transition: var(--transition);
        }

        body.dark {
            color: var(--text-dark);
            background-color: var(--bg-dark);
        }

        /* Контейнер с ограничением по ширине */
        .container {
            width: 100%;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Кнопки */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-align: center;
            border-radius: 2rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-light);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: scale(1.05);
        }

        .dark .btn-primary {
            background-color: var(--primary-dark);
        }

        .dark .btn-primary:hover {
            background-color: var(--primary-light);
        }

        /* Анимации */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Хедер */
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .dark header {
            background-color: rgba(17, 24, 39, 0.9);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
        }

        /* Логотип */
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dark .logo-icon {
            background-color: var(--primary-dark);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-light);
        }

        .dark .logo-text {
            color: var(--text-dark);
        }

        .logo-highlight {
            color: var(--primary-light);
        }

        .dark .logo-highlight {
            color: var(--primary-dark);
        }

        /* Навигация */
        .nav-desktop {
            display: none;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
        }

        .dark .nav-link {
            color: var(--text-dark);
        }

        .nav-link:hover {
            color: var(--primary-light);
        }

        .dark .nav-link:hover {
            color: var(--primary-dark);
        }

        /* Иконки в хедере */
        .header-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .icon-btn {
            padding: 0.5rem;
            border-radius: 50%;
            transition: var(--transition);
            cursor: pointer;
            background: none;
            border: none;
            color: var(--text-light);
        }

        .dark .icon-btn {
            color: var(--text-dark);
        }

        .icon-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .dark .icon-btn:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .cart-badge {
            position: absolute;
            top: -0.25rem;
            right: -0.25rem;
            background-color: var(--primary-light);
            color: white;
            font-size: 0.75rem;
            border-radius: 50%;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dark .cart-badge {
            background-color: var(--primary-dark);
        }

        /* Мобильное меню */
        .mobile-menu {
            display: none;
            background-color: var(--white);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dark .mobile-menu {
            background-color: var(--bg-dark);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .mobile-menu.active {
            display: flex;
            flex-direction: column;
            padding: 1rem 0;
        }

        .mobile-menu .nav-link {
            padding: 0.5rem 1rem;
            display: block;
            color: var(--text-light);
        }

        .dark .mobile-menu .nav-link {
            color: var(--text-dark);
        }

        /* Стили для личного кабинета */
        .profile {
            padding: 4rem 0;
        }

        .profile-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--text-light);
        }

        .dark .profile-title {
            color: var(--text-dark);
        }

        .profile-grid {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1fr;
        }

        @media (min-width: 1024px) {
            .profile-grid {
                grid-template-columns: 300px 1fr;
            }
        }

        .profile-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dark .profile-card {
            background-color: var(--gray-dark);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
        }

        .dark .user-avatar {
            background-color: var(--primary-dark);
        }

        .user-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-light);
        }

        .dark .user-name {
            color: var(--text-dark);
        }

        .user-email {
            font-size: 1rem;
            color: var(--gray-dark);
        }

        .dark .user-email {
            color: var(--gray-light);
        }

        .menu-list {
            list-style: none;
        }

        .menu-item {
            margin-bottom: 0.5rem;
        }

        .menu-link {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
        }

        .dark .menu-link {
            color: var(--text-dark);
        }

        .menu-link:hover, .menu-link.active {
            background-color: var(--primary-light);
            color: white;
        }

        .dark .menu-link:hover, .dark .menu-link.active {
            background-color: var(--primary-dark);
        }

        .content-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-light);
        }

        .dark .content-title {
            color: var(--text-dark);
        }

        .favorites-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .favorite-item {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .dark .favorite-item {
            background-color: var(--gray-dark);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .favorite-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .dark .favorite-item:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        .favorite-img {
            width: 100%;
            height: 120px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .favorite-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-light);
        }

        .dark .favorite-name {
            color: var(--text-dark);
        }

        .favorite-price {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-light);
        }

        .dark .favorite-price {
            color: var(--primary-dark);
        }

       .user-details p {
            color: var(--text-light);
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-light);
     }

       .dark .user-details p {
            color: var(--text-dark-highlight);
            border-bottom-color: var(--gray-dark);
    }

        .user-details .form-label {
           color: var(--text-light);
           font-weight: 500;
           margin-bottom: 0.25rem;
    }

        .dark .user-details .form-label {
            color: var(--text-muted-dark);
    }

        /* Футер */
        footer {
            background-color: var(--gray-dark);
            color: var(--gray-light);
            padding: 3rem 0;
        }

        .footer-container {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1fr;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .footer-logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--white);
        }

        .footer-logo-highlight {
            color: var(--primary-light);
        }

        .footer-about {
            margin-bottom: 1rem;
            color: var(--gray-light);
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            color: var(--gray-light);
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .social-link:hover {
            color: var(--white);
        }

        .footer-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-link {
            margin-bottom: 0.5rem;
        }

        .footer-link a {
            color: var(--gray-light);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-link a:hover {
            color: var(--white);
        }

        .footer-contact {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .contact-icon {
            color: var(--primary-light);
            margin-top: 0.25rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.875rem;
        }
        
        .dark #no-cart-items p {
    color: var(--text-dark);
}

        /* Адаптивные стили */
        @media (min-width: 768px) {
            .nav-desktop {
                display: flex;
                gap: 2rem;
            }
            
            .mobile-menu-btn {
                display: none;
            }
            
            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .footer-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Стили для форм авторизации и регистрации */
        .auth-container {
            max-width: 500px;
            margin: 4rem auto;
            padding: 2rem;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dark .auth-container {
            background-color: var(--gray-dark);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .auth-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--text-light);
        }

        .dark .auth-title {
            color: var(--text-dark);
        }

        .auth-form {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-light);
        }

        .dark .form-label {
            color: var(--text-dark);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-light);
            background-color: var(--white);
            color: var(--text-light);
            transition: var(--transition);
        }

        .dark .form-input {
            border-color: var(--gray-dark);
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .dark .form-input:focus {
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        .auth-footer {
            margin-top: 1.5rem;
            text-align: center;
            color: var(--text-light);
        }

        .dark .auth-footer {
            color: var(--text-dark);
        }

        .auth-link {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
        }

        .dark .auth-link {
            color: var(--primary-dark);
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Стили для кнопки добавления в избранное */
        .favorite-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: var(--white);
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: none;
            color: var(--text-light);
            transition: var(--transition);
        }

        .dark .favorite-btn {
            background-color: var(--gray-dark);
            color: var(--text-dark);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .favorite-btn.active {
            color: #ef4444;
        }

        .favorite-btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Хедер -->
    <header>
        <div class="container header-container">
            <!-- Логотип -->
            <a href="index.html" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-microchip text-white"></i>
                </div>
                <span class="logo-text">Gadget<span class="logo-highlight">Zone</span></span>
            </a>

            <!-- Навигация для десктопа -->
            <nav class="nav-desktop">
                <a href="catalog.html" class="nav-link">Каталог</a>
                <a href="compare.html" class="nav-link">Сравнение</a>
                <a href="simulator.html" class="nav-link">Симулятор</a>
                <a href="accessories.html" class="nav-link">Аксессуары</a>
                <a href="calculator.html" class="nav-link">Калькулятор</a>
                <a href="contacts.html" class="nav-link">Контакты</a>
            </nav>

            <!-- Иконки -->
            <div class="header-icons">
                <!-- Профиль -->
                <a href="profile.html" class="icon-btn">
                    <i class="fas fa-user"></i>
                </a>
                
                <!-- Переключатель темы -->
                <button id="theme-toggle" class="icon-btn">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
                                
                <!-- Корзина -->
                <a href="korzina.html" class="icon-btn relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge">3</span>
                </a>
                                
                <!-- Кнопка мобильного меню -->
                <button id="mobile-menu-button" class="icon-btn md:hidden">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div id="mobile-menu" class="mobile-menu">
            <div class="container">
                <a href="catalog.html" class="nav-link">Каталог</a>
                <a href="compare.html" class="nav-link">Сравнение</a>
                <a href="simulator.html" class="nav-link">Симулятор</a>
                <a href="accessories.html" class="nav-link">Аксессуары</a>
                <a href="calculator.html" class="nav-link">Калькулятор</a>
                <a href="contacts.html" class="nav-link">Контакты</a>
                <a href="profile.html" class="nav-link">Профиль</a>
                <a href="korzina.html" class="nav-link">Корзина</a>
            </div>
        </div>
    </header>

    <!-- Контент страницы (будет заменяться в зависимости от состояния) -->
    <main id="main-content">
        <!-- Здесь будет отображаться либо форма входа/регистрации, либо профиль -->
    </main>

    <!-- Футер -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div>
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <i class="fas fa-microchip text-white"></i>
                        </div>
                        <span class="footer-logo-text">Gadget<span class="footer-logo-highlight">Zone</span></span>
                    </div>
                    <p class="footer-about">Ваш надежный гид в мире технологий и гаджетов. Мы помогаем сделать правильный выбор.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="fab fa-vk"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-telegram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="footer-title">Навигация</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="index.html">Главная</a></li>
                        <li class="footer-link"><a href="catalog.html">Каталог</a></li>
                        <li class="footer-link"><a href="compare.html">Сравнение</a></li>
                        <li class="footer-link"><a href="simulator.html">Симулятор</a></li>
                        <li class="footer-link"><a href="accessories.html">Аксессуары</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="footer-title">Помощь</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="faq.html">FAQ</a></li>
                        <li class="footer-link"><a href="delivery.html">Доставка и оплата</a></li>
                        <li class="footer-link"><a href="warranty.html">Гарантия</a></li>
                        <li class="footer-link"><a href="reviews.html">Отзывы</a></li>
                        <li class="footer-link"><a href="blog.html">Блог</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="footer-title">Контакты</h3>
                    <ul class="footer-links">
                        <li class="footer-contact">
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <span>Москва, ул. Технологическая, 42</span>
                        </li>
                        <li class="footer-contact">
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <span>+7 (495) 123-45-67</span>
                        </li>
                        <li class="footer-contact">
                            <i class="fas fa-envelope contact-icon"></i>
                            <span>info@gadgetzone.ru</span>
                        </li>
                        <li class="footer-contact">
                            <i class="fas fa-clock contact-icon"></i>
                            <span>Пн-Пт: 9:00-21-00</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>© 2025 GadgetZone. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <!-- Шаблоны для динамического контента -->
    <template id="login-template">
        <div class="auth-container">
            <h2 class="auth-title">Вход в аккаунт</h2>
            <form id="login-form" class="auth-form">
                <div class="form-group">
                    <label for="login-email" class="form-label">Email</label>
                    <input type="email" id="login-email" class="form-input" placeholder="Введите ваш email" required>
                    <div id="login-email-error" class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="login-password" class="form-label">Пароль</label>
                    <input type="password" id="login-password" class="form-input" placeholder="Введите ваш пароль" required>
                    <div id="login-password-error" class="error-message"></div>
                </div>
                
                <button type="submit" class="btn btn-primary">Войти</button>
                
                <div class="auth-footer">
                    <p>Еще нет аккаунта? <a href="#" id="show-register" class="auth-link">Зарегистрироваться</a></p>
                </div>
            </form>
        </div>
    </template>

    <template id="register-template">
        <div class="auth-container">
            <h2 class="auth-title">Регистрация</h2>
            <form id="register-form" class="auth-form">
                <div class="form-group">
                    <label for="register-name" class="form-label">Имя</label>
                    <input type="text" id="register-name" class="form-input" placeholder="Введите ваше имя" required>
                    <div id="register-name-error" class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="register-email" class="form-label">Email</label>
                    <input type="email" id="register-email" class="form-input" placeholder="Введите ваш email" required>
                    <div id="register-email-error" class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="register-password" class="form-label">Пароль</label>
                    <input type="password" id="register-password" class="form-input" placeholder="Введите пароль" required>
                    <div id="register-password-error" class="error-message"></div>
                </div>
                
                <div class="form-group">
                    <label for="register-confirm-password" class="form-label">Подтвердите пароль</label>
                    <input type="password" id="register-confirm-password" class="form-input" placeholder="Повторите пароль" required>
                    <div id="register-confirm-password-error" class="error-message"></div>
                </div>
                
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                
                <div class="auth-footer">
                    <p>Уже есть аккаунт? <a href="#" id="show-login" class="auth-link">Войти</a></p>
                </div>
            </form>
        </div>
    </template>

    <template id="profile-template">
        <!-- Личный кабинет -->
        <section class="profile">
            <div class="container">
                <h1 class="profile-title">Личный кабинет</h1>
                
                <div class="profile-grid">
                    <!-- Боковое меню -->
                    <div class="profile-card">
                        <div class="user-info">
                            <div class="user-avatar" id="user-avatar">JD</div>
                            <h2 class="user-name" id="user-name">John Doe</h2>
                            <p class="user-email" id="user-email">john.doe@example.com</p>
                        </div>
                        
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="#" class="menu-link active" data-tab="info">
                                    <i class="fas fa-user-circle mr-2"></i>Информация
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="menu-link" data-tab="cart">
                                    <i class="fas fa-shopping-cart mr-2"></i>Корзина
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" class="menu-link" id="logout-btn">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Выйти
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Основное содержимое -->
                    <div class="profile-card">
                        <!-- Информация о пользователе -->
                        <div id="info-tab" class="tab-content active">
                            <h2 class="content-title">Информация о пользователе</h2>
                            
                            <div class="user-details">
                                <div class="form-group">
                                    <label class="form-label">Имя:</label>
                                    <p id="user-fullname">John Doe</p>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Email:</label>
                                    <p id="user-email-info">john.doe@example.com</p>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Дата регистрации:</label>
                                    <p id="user-regdate">15 января 2024</p>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Телефон:</label>
                                    <p id="user-phone">+7 (123) 456-78-90</p>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Адрес:</label>
                                    <p id="user-address">Москва, ул. Примерная, д. 123, кв. 45</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Корзина -->
                        <div id="cart-tab" class="tab-content">
                            <h2 class="content-title">Избранное</h2>
                            <div id="no-cart-items" style="display: none;">
                                <p>В вашем избранном пока ничего нет.</p>
                            </div>
                            <div id="cart-list" class="favorites-grid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>

    <!-- Скрипты -->
    <script>
        // Переключение темы
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        
        // Проверяем сохраненную тему или системные настройки
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Обработчик клика по переключателю
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });
        
        // Мобильное меню
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });
        
        // База данных пользователей (хранится в localStorage в формате JSON)
        let users = JSON.parse(localStorage.getItem('users')) || [];
        let currentUser = JSON.parse(localStorage.getItem('currentUser')) || null;
        
        // Основной контейнер для контента
        const mainContent = document.getElementById('main-content');
        
        // Функция для отображения формы входа
        function showLoginForm() {
            const loginTemplate = document.getElementById('login-template').content.cloneNode(true);
            mainContent.innerHTML = '';
            mainContent.appendChild(loginTemplate);
            
            // Обработчики для формы входа
            document.getElementById('login-form').addEventListener('submit', handleLogin);
            document.getElementById('show-register').addEventListener('click', (e) => {
                e.preventDefault();
                showRegisterForm();
            });
        }
        
        // Функция для отображения формы регистрации
        function showRegisterForm() {
            const registerTemplate = document.getElementById('register-template').content.cloneNode(true);
            mainContent.innerHTML = '';
            mainContent.appendChild(registerTemplate);
            
            // Обработчики для формы регистрации
            document.getElementById('register-form').addEventListener('submit', handleRegister);
            document.getElementById('show-login').addEventListener('click', (e) => {
                e.preventDefault();
                showLoginForm();
            });
        }
        
        // Функция для отображения профиля
        function showProfile() {
            const profileTemplate = document.getElementById('profile-template').content.cloneNode(true);
            mainContent.innerHTML = '';
            mainContent.appendChild(profileTemplate);
            
            // Загружаем данные пользователя
            loadUserData();
            
            // Управление вкладками в личном кабинете
            const tabLinks = document.querySelectorAll('.menu-link[data-tab]');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    // Удаляем активный класс у всех ссылок и вкладок
                    tabLinks.forEach(l => l.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Добавляем активный класс к текущей ссылке
                    link.classList.add('active');
                    
                    // Показываем соответствующую вкладку
                    const tabId = link.getAttribute('data-tab');
                    document.getElementById(`${tabId}-tab`).classList.add('active');
                });
            });
            
            // Выход из аккаунта
            document.getElementById('logout-btn').addEventListener('click', handleLogout);
        }
        
        // Обработчик входа
        function handleLogin(e) {
            e.preventDefault();
            
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            // Сбрасываем ошибки
            document.getElementById('login-email-error').textContent = '';
            document.getElementById('login-password-error').textContent = '';
            
            // Валидация
            let isValid = true;
            
            if (!email) {
                document.getElementById('login-email-error').textContent = 'Введите email';
                isValid = false;
            }
            
            if (!password) {
                document.getElementById('login-password-error').textContent = 'Введите пароль';
                isValid = false;
            }
            
            if (!isValid) return;
            
            // Поиск пользователя в JSON данных
            const user = users.find(u => u.email === email && u.password === password);
            
            if (user) {
                // Успешный вход
                currentUser = user;
                localStorage.setItem('currentUser', JSON.stringify(currentUser));
                showProfile();
            } else {
                document.getElementById('login-password-error').textContent = 'Неверный email или пароль';
            }
        }
        
        // Обработчик регистрации
        function handleRegister(e) {
            e.preventDefault();
            
            const name = document.getElementById('register-name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            
            // Сбрасываем ошибки
            document.getElementById('register-name-error').textContent = '';
            document.getElementById('register-email-error').textContent = '';
            document.getElementById('register-password-error').textContent = '';
            document.getElementById('register-confirm-password-error').textContent = '';
            
            // Валидация
            let isValid = true;
            
            if (!name) {
                document.getElementById('register-name-error').textContent = 'Введите имя';
                isValid = false;
            }
            
            if (!email) {
                document.getElementById('register-email-error').textContent = 'Введите email';
                isValid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                document.getElementById('register-email-error').textContent = 'Введите корректный email';
                isValid = false;
            } else if (users.some(u => u.email === email)) {
                document.getElementById('register-email-error').textContent = 'Пользователь с таким email уже существует';
                isValid = false;
            }
            
            if (!password) {
                document.getElementById('register-password-error').textContent = 'Введите пароль';
                isValid = false;
            } else if (password.length < 6) {
                document.getElementById('register-password-error').textContent = 'Пароль должен содержать не менее 6 символов';
                isValid = false;
            }
            
            if (!confirmPassword) {
                document.getElementById('register-confirm-password-error').textContent = 'Подтвердите пароль';
                isValid = false;
            } else if (password !== confirmPassword) {
                document.getElementById('register-confirm-password-error').textContent = 'Пароли не совпадают';
                isValid = false;
            }
            
            if (!isValid) return;
            
            // Создаем нового пользователя
            const newUser = {
                id: Date.now(),
                name: name,
                email: email,
                password: password,
                phone: '',
                address: '',
                regDate: new Date().toLocaleDateString('ru-RU', { year: 'numeric', month: 'long', day: 'numeric' }),
                cart: []
            };
            
            // Добавляем пользователя в базу (сохраняем в localStorage как JSON)
            users.push(newUser);
            localStorage.setItem('users', JSON.stringify(users));
            
            // Автоматически входим
            currentUser = newUser;
            localStorage.setItem('currentUser', JSON.stringify(currentUser));
            
            // Показываем профиль
            showProfile();
        }
        
        // Обработчик выхода
        function handleLogout(e) {
            e.preventDefault();
            currentUser = null;
            localStorage.removeItem('currentUser');
            showLoginForm();
        }
        
        // Заполняем данные пользователя
        function loadUserData() {
            document.getElementById('user-avatar').textContent = getInitials(currentUser.name);
            document.getElementById('user-name').textContent = currentUser.name;
            document.getElementById('user-email').textContent = currentUser.email;
            document.getElementById('user-fullname').textContent = currentUser.name;
            document.getElementById('user-email-info').textContent = currentUser.email;
            document.getElementById('user-regdate').textContent = currentUser.regDate;
            document.getElementById('user-phone').textContent = currentUser.phone || 'Не указан';
            document.getElementById('user-address').textContent = currentUser.address || 'Не указан';
            
            // Загружаем корзину
            loadCart();
        }
        
        // Получаем инициалы из имени
        function getInitials(name) {
            return name.split(' ').map(part => part[0]).join('').toUpperCase();
        }
        
        // Загрузка корзины
        function loadCart() {
            const cartList = document.getElementById('cart-list');
            const noCartItems = document.getElementById('no-cart-items');
            
            cartList.innerHTML = '';
            
            if (currentUser.cart && currentUser.cart.length > 0) {
                noCartItems.style.display = 'none';
                
                // Демо-товары (в реальном приложении это будут данные из базы)
                const demoProducts = [
                    { id: 1, name: 'iPhone 14 Pro', price: 89990, image: 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-14-pro-model-unselect-gallery-2-202209?wid=5120&hei=2880&fmt=p-jpg&qlt=80&.v=1660753619946' },
                    { id: 2, name: 'Samsung Galaxy S23 Ultra', price: 84990, image: 'https://images.samsung.com/is/image/samsung/p6pim/ru/2302/gallery/ru-galaxy-s23-s918-456067-sm-s918bzadser-534866385?$650_519_PNG$' },
                    { id: 3, name: 'Apple Watch Series 8', price: 39990, image: 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/MQDY3ref_VW_34FR+watch-45-alum-midnight-nc-8s_VW_34FR_WF_CO?wid=1400&hei=1400&trim=1%2C0&fmt=p-jpg&qlt=95&.v=1661471049497%2C1661633316261' }
                ];
                
                // Показываем только те товары, которые есть в корзине
                currentUser.cart.forEach(cartId => {
                    const product = demoProducts.find(p => p.id === cartId);
                    if (product) {
                        const cartItem = document.createElement('div');
                        cartItem.className = 'favorite-item';
                        cartItem.innerHTML = `
                            <img src="${product.image}" alt="${product.name}" class="favorite-img">
                            <h3 class="favorite-name">${product.name}</h3>
                            <p class="favorite-price">${product.price.toLocaleString('ru-RU')} ₽</p>
                            <button class="remove-from-cart mt-2 text-sm text-red-500" data-id="${product.id}">
                                <i class="fas fa-trash-alt mr-1"></i>Удалить
                            </button>
                        `;
                        cartList.appendChild(cartItem);
                    }
                });
                
                // Обработчики для кнопок удаления
                document.querySelectorAll('.remove-from-cart').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const productId = parseInt(this.getAttribute('data-id'));
                        removeFromCart(productId);
                    });
                });
            } else {
                noCartItems.style.display = 'block';
            }
        }
        
        // Удаление из корзины
        function removeFromCart(productId) {
            currentUser.cart = currentUser.cart.filter(id => id !== productId);
            
            // Обновляем данные в localStorage (как JSON)
            const userIndex = users.findIndex(u => u.id === currentUser.id);
            if (userIndex !== -1) {
                users[userIndex] = currentUser;
                localStorage.setItem('users', JSON.stringify(users));
                localStorage.setItem('currentUser', JSON.stringify(currentUser));
            }
            
            // Перезагружаем корзину
            loadCart();
        }
        
        // Проверяем состояние при загрузке страницы
        window.addEventListener('DOMContentLoaded', () => {
            if (currentUser) {
                showProfile();
            } else {
                showLoginForm();
            }
        });
    </script>
</body>
</html>