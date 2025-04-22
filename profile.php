<?php
// Начало сессии для хранения текущего пользователя
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | GadgetZone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .theme-transition * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        
        .dark .dark\:bg-gray-800 {
            background-color: #1f2937;
        }
        
        .dark .dark\:bg-gray-700 {
            background-color: #374151;
        }
        
        .dark .dark\:text-white {
            color: #fff;
        }
        
        .dark .dark\:border-gray-600 {
            border-color: #4b5563;
        }
        
        .dark .dark\:hover\:bg-gray-600:hover {
            background-color: #4b5563;
        }
        
        .avatar-upload {
            position: relative;
            display: inline-block;
        }
        
        .avatar-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .avatar-edit {
            position: absolute;
            right: 10px;
            bottom: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        
        .dark .avatar-edit {
            background: rgba(255,255,255,0.7);
            color: black;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }
        
        .auth-form {
            max-width: 400px;
            margin: 0 auto;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Стили из index.html */
        :root {
            --primary-light: #3b82f6;
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

        .container {
            width: 100%;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 1rem;
        }

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

        @media (min-width: 768px) {
            .nav-desktop {
                display: flex;
                gap: 2rem;
            }
            
            .mobile-menu-btn {
                display: none;
            }
        }
    </style>
</head>
<body class="theme-transition">
    <!-- Хедер -->
    <header>
        <div class="container header-container">
            <!-- Логотип -->
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-microchip text-white"></i>
                </div>
                <span class="logo-text">Gadget<span class="logo-highlight">Zone</span></span>
            </a>

            <!-- Навигация для десктопа -->
            <nav class="nav-desktop">
                <a href="catalog.php" class="nav-link">Каталог</a>
                <a href="compare.php" class="nav-link">Сравнение</a>
                <a href="simulator.php" class="nav-link">Симулятор</a>
                <a href="accessories.php" class="nav-link">Аксессуары</a>
                <a href="calculator.php" class="nav-link">Калькулятор</a>
                <a href="contacts.php" class="nav-link">Контакты</a>
            </nav>

            <!-- Иконки -->
            <div class="header-icons">
                <!-- Профиль -->
                <a href="profile.php" class="icon-btn">
                    <i class="fas fa-user"></i>
                </a>
                
                <!-- Переключатель темы -->
                <button id="theme-toggle" class="icon-btn">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
                                
                <!-- Корзина -->
                <a href="korzina.php" class="icon-btn relative">
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
                <a href="catalog.php" class="nav-link">Каталог</a>
                <a href="compare.php" class="nav-link">Сравнение</a>
                <a href="simulator.php" class="nav-link">Симулятор</a>
                <a href="accessories.php" class="nav-link">Аксессуары</a>
                <a href="calculator.php" class="nav-link">Калькулятор</a>
                <a href="contacts.php" class="nav-link">Контакты</a>
                <a href="profile.php" class="nav-link">Профиль</a>
                <a href="korzina.php" class="nav-link">Корзина</a>
            </div>
        </div>
    </header>

    <div id="auth-container" class="container mx-auto px-4 py-8 <?php echo isset($_SESSION['user']) ? 'hidden' : ''; ?>">
        <div class="flex justify-center">
            <div class="auth-form bg-white dark:bg-gray-700 rounded-lg shadow-md p-8 w-full">
                <div class="flex justify-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Вход в личный кабинет</h1>
                </div>
                
                <div id="auth-tabs" class="flex border-b border-gray-200 dark:border-gray-600 mb-6">
                    <button id="login-tab" class="flex-1 py-2 px-4 font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400">Вход</button>
                    <button id="register-tab" class="flex-1 py-2 px-4 font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">Регистрация</button>
                </div>
                
                <!-- Форма входа -->
                <form id="login-form" class="space-y-4">
                    <div>
                        <label for="login-email" class="block text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" id="login-email" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="login-password" class="block text-gray-700 dark:text-gray-300 mb-1">Пароль</label>
                        <input type="password" id="login-password" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember-me" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Запомнить меня</label>
                        </div>
                        
                        <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Забыли пароль?</a>
                    </div>
                    
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Войти</button>
                    
                    <div id="login-error" class="text-red-500 text-sm hidden"></div>
                </form>
                
                <!-- Форма регистрации -->
                <form id="register-form" class="space-y-4 hidden">
                    <div>
                        <label for="register-name" class="block text-gray-700 dark:text-gray-300 mb-1">Имя</label>
                        <input type="text" id="register-name" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="register-email" class="block text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" id="register-email" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="register-password" class="block text-gray-700 dark:text-gray-300 mb-1">Пароль</label>
                        <input type="password" id="register-password" required minlength="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="register-confirm-password" class="block text-gray-700 dark:text-gray-300 mb-1">Подтвердите пароль</label>
                        <input type="password" id="register-confirm-password" required minlength="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="terms" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Я согласен с <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">условиями использования</a></label>
                    </div>
                    
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Зарегистрироваться</button>
                    
                    <div id="register-error" class="text-red-500 text-sm hidden"></div>
                    <div id="register-success" class="text-green-500 text-sm hidden">Регистрация прошла успешно! Теперь вы можете войти.</div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="profile-container" class="container mx-auto px-4 py-8 <?php echo !isset($_SESSION['user']) ? 'hidden' : ''; ?>">
        <!-- Основное содержимое -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Боковая панель -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                    <!-- Аватар и информация -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="avatar-upload mb-4">
                            <div class="w-32 h-32 rounded-full bg-gray-200 dark:bg-gray-600 overflow-hidden">
                                <img id="avatar-preview" src="<?php echo isset($_SESSION['user']['avatar']) ? $_SESSION['user']['avatar'] : 'https://via.placeholder.com/128'; ?>" alt="Аватар" class="w-full h-full object-cover">
                            </div>
                            <div class="avatar-edit">
                                <i class="fas fa-camera"></i>
                                <input type="file" id="avatar-input" accept="image/*">
                            </div>
                        </div>
                        <h2 id="user-name" class="text-xl font-semibold text-gray-800 dark:text-white"><?php echo isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : ''; ?></h2>
                        <p id="user-email" class="text-gray-600 dark:text-gray-300"><?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : ''; ?></p>
                        <p id="user-join-date" class="text-gray-600 dark:text-gray-300 text-sm">Пользователь с <?php echo isset($_SESSION['user']['joinDate']) ? $_SESSION['user']['joinDate'] : date('Y-m-d'); ?></p>
                    </div>
                    
                    <!-- Навигация -->
                    <nav>
                        <ul>
                            <li>
                                <button data-tab="profile" class="tab-btn w-full text-left px-4 py-3 rounded-lg mb-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 font-medium">
                                    <i class="fas fa-user mr-2"></i>Профиль
                                </button>
                            </li>
                            <li>
                                <button data-tab="favorites" class="tab-btn w-full text-left px-4 py-3 rounded-lg mb-2 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200">
                                    <i class="fas fa-heart mr-2"></i>Избранное
                                </button>
                            </li>
                            <li>
                                <button id="logout-btn" class="w-full text-left px-4 py-3 rounded-lg mb-2 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Выйти
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <!-- Статистика -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Статистика</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 dark:text-gray-300">Заказов</p>
                            <p id="orders-count" class="text-xl font-bold text-gray-800 dark:text-white"><?php echo isset($_SESSION['user']['ordersCount']) ? $_SESSION['user']['ordersCount'] : 0; ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300">Избранных товаров</p>
                            <p id="favorites-count" class="text-xl font-bold text-gray-800 dark:text-white"><?php echo isset($_SESSION['user']['favorites']) ? count($_SESSION['user']['favorites']) : 0; ?></p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300">Бонусных баллов</p>
                            <p id="bonus-points" class="text-xl font-bold text-gray-800 dark:text-white"><?php echo isset($_SESSION['user']['bonusPoints']) ? $_SESSION['user']['bonusPoints'] : 0; ?></p>
                        </div>
                    </div>
                </div>
            </aside>
            
            <!-- Основной контент -->
            <main class="w-full lg:w-3/4">
                <!-- Вкладка профиля -->
                <div id="profile" class="tab-content active">
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Информация о профиле</h2>
                        
                        <form id="profile-form">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="first-name" class="block text-gray-700 dark:text-gray-300 mb-2">Имя</label>
                                    <input type="text" id="first-name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white" value="<?php echo isset($_SESSION['user']['firstName']) ? $_SESSION['user']['firstName'] : ''; ?>">
                                </div>
                                <div>
                                    <label for="last-name" class="block text-gray-700 dark:text-gray-300 mb-2">Фамилия</label>
                                    <input type="text" id="last-name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white" value="<?php echo isset($_SESSION['user']['lastName']) ? $_SESSION['user']['lastName'] : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="phone" class="block text-gray-700 dark:text-gray-300 mb-2">Телефон</label>
                                <input type="tel" id="phone" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white" value="<?php echo isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : ''; ?>">
                            </div>
                            
                            <div class="mb-6">
                                <label for="address" class="block text-gray-700 dark:text-gray-300 mb-2">Адрес</label>
                                <textarea id="address" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white"><?php echo isset($_SESSION['user']['address']) ? $_SESSION['user']['address'] : ''; ?></textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Сохранить изменения</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Безопасность</h2>
                        
                        <div class="space-y-4">
                            <div class="flex flex-col md:flex-row md:items-center justify-between p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                                <div class="mb-2 md:mb-0">
                                    <h3 class="font-medium text-gray-800 dark:text-white">Пароль</h3>
                                    <p id="password-change-date" class="text-gray-600 dark:text-gray-300">Последнее изменение: <?php echo isset($_SESSION['user']['passwordChangeDate']) ? $_SESSION['user']['passwordChangeDate'] : 'никогда'; ?></p>
                                </div>
                                <button id="change-password-btn" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition">Изменить пароль</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Вкладка избранного -->
                <div id="favorites" class="tab-content">
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Избранные товары</h2>
                            <div class="flex items-center">
                                <span class="text-gray-600 dark:text-gray-300 mr-2">Сортировка:</span>
                                <select id="favorites-sort" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                                    <option value="date">По дате добавления</option>
                                    <option value="price-asc">По цене (возрастание)</option>
                                    <option value="price-desc">По цене (убывание)</option>
                                    <option value="popularity">По популярности</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="favorites-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php
                            // Пример товаров для избранного
                            $sampleProducts = [
                                ['id' => 1, 'name' => "Смартфон Premium X", 'description' => "Высококачественный смартфон с продвинутой камерой", 'price' => 45990, 'image' => "https://via.placeholder.com/300x200", 'dateAdded' => "2023-05-15"],
                                ['id' => 2, 'name' => "Умные часы Pro", 'description' => "Мониторинг здоровья и уведомления", 'price' => 12490, 'image' => "https://via.placeholder.com/300x200", 'dateAdded' => "2023-06-20"],
                                ['id' => 3, 'name' => "Беспроводные наушники", 'description' => "Высокое качество звука с шумоподавлением", 'price' => 8990, 'image' => "https://via.placeholder.com/300x200", 'dateAdded' => "2023-07-10"],
                                ['id' => 4, 'name' => "Ноутбук Ultra", 'description' => "Мощный и легкий для работы и развлечений", 'price' => 89990, 'image' => "https://via.placeholder.com/300x200", 'dateAdded' => "2023-08-05"],
                                ['id' => 5, 'name' => "Фитнес-браслет", 'description' => "Отслеживание активности и сна", 'price' => 3490, 'image' => "https://via.placeholder.com/300x200", 'dateAdded' => "2023-08-15"],
                                ['id' => 6, 'name' => "Электронная книга", 'description' => "Комфортное чтение без вреда для глаз", 'price' => 6990, 'image' => "https://via.placeholder.com/300x200", 'dateAdded' => "2023-09-01"]
                            ];
                            
                            if (isset($_SESSION['user']['favorites']) && count($_SESSION['user']['favorites']) > 0) {
                                foreach ($sampleProducts as $product) {
                                    if (in_array($product['id'], $_SESSION['user']['favorites'])) {
                                        echo '
                                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg overflow-hidden hover:shadow-lg transition">
                                            <div class="relative">
                                                <img src="'.$product['image'].'" alt="'.$product['name'].'" class="w-full h-48 object-cover">
                                                <button class="remove-favorite absolute top-2 right-2 p-2 bg-white dark:bg-gray-800 rounded-full text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition" data-id="'.$product['id'].'">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="p-4">
                                                <h3 class="font-semibold text-lg text-gray-800 dark:text-white mb-2">'.$product['name'].'</h3>
                                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">'.$product['description'].'</p>
                                                <div class="flex justify-between items-center">
                                                    <span class="font-bold text-gray-800 dark:text-white">'.number_format($product['price'], 0, '', ' ').' ₽</span>
                                                    <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">В корзину</button>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                            } else {
                                echo '<p class="text-gray-600 dark:text-gray-300 col-span-3 text-center py-8">У вас пока нет избранных товаров</p>';
                            }
                            ?>
                        </div>
                        
                        <div class="mt-8 flex justify-center">
                            <button id="load-more-favorites" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                Показать еще
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Модальное окно смены пароля -->
    <div id="change-password-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Изменение пароля</h3>
                <button id="close-password-modal" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="change-password-form" class="space-y-4">
                <div>
                    <label for="current-password" class="block text-gray-700 dark:text-gray-300 mb-1">Текущий пароль</label>
                    <input type="password" id="current-password" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                </div>
                
                <div>
                    <label for="new-password" class="block text-gray-700 dark:text-gray-300 mb-1">Новый пароль</label>
                    <input type="password" id="new-password" required minlength="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                </div>
                
                <div>
                    <label for="confirm-new-password" class="block text-gray-700 dark:text-gray-300 mb-1">Подтвердите новый пароль</label>
                    <input type="password" id="confirm-new-password" required minlength="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                </div>
                
                <div id="password-change-error" class="text-red-500 text-sm hidden"></div>
                
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" id="cancel-password-change" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 transition">Отмена</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Изменить пароль</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', () => {
            // Инициализация темы
            initTheme();
            
            // Инициализация обработчиков событий
            initEventHandlers();
        });
        
        // Функция для авторизации
        async function login(email, password) {
            try {
                const response = await fetch('auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'login',
                        email: email,
                        password: password
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при авторизации:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Функция для регистрации
        async function register(name, email, password) {
            try {
                const response = await fetch('auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'register',
                        name: name,
                        email: email,
                        password: password
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при регистрации:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Функция для обновления профиля
        async function updateProfile(userId, data) {
            try {
                const response = await fetch('profile.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update',
                        id: userId,
                        data: data
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при обновлении профиля:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Функция для изменения пароля
        async function changePassword(userId, currentPassword, newPassword) {
            try {
                const response = await fetch('profile.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'change-password',
                        id: userId,
                        currentPassword: currentPassword,
                        newPassword: newPassword
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при изменении пароля:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Функция для обновления аватара
        async function updateAvatar(userId, avatar) {
            try {
                const response = await fetch('profile.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update-avatar',
                        id: userId,
                        avatar: avatar
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при обновлении аватара:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Функция для обновления избранного
        async function updateFavorites(userId, favorites) {
            try {
                const response = await fetch('profile.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update-favorites',
                        id: userId,
                        favorites: favorites
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при обновлении избранного:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Функция для выхода из системы
        async function logout() {
            try {
                const response = await fetch('auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'logout'
                    })
                });
                
                return await response.json();
            } catch (error) {
                console.error('Ошибка при выходе:', error);
                return { success: false, error: 'Ошибка соединения с сервером' };
            }
        }
        
        // Показать форму авторизации
        function showAuth() {
            document.getElementById('auth-container').classList.remove('hidden');
            document.getElementById('profile-container').classList.add('hidden');
        }
        
        // Показать профиль
        function showProfile() {
            document.getElementById('auth-container').classList.add('hidden');
            document.getElementById('profile-container').classList.remove('hidden');
        }
        
        // Инициализация темы
        function initTheme() {
            const html = document.documentElement;
            const savedTheme = localStorage.getItem('theme') || 'light';
            
            // Применяем сохраненную тему
            if (savedTheme === 'dark') {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        }
        
        // Инициализация обработчиков событий
        function initEventHandlers() {
            // Переключение между вкладками входа и регистрации
            document.getElementById('login-tab').addEventListener('click', () => {
                document.getElementById('login-form').classList.remove('hidden');
                document.getElementById('register-form').classList.add('hidden');
                document.getElementById('login-tab').classList.add('text-blue-600', 'dark:text-blue-400', 'border-b-2', 'border-blue-600', 'dark:border-blue-400');
                document.getElementById('register-tab').classList.remove('text-blue-600', 'dark:text-blue-400', 'border-b-2', 'border-blue-600', 'dark:border-blue-400');
                document.getElementById('register-tab').classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-800', 'dark:hover:text-gray-200');
            });
            
            document.getElementById('register-tab').addEventListener('click', () => {
                document.getElementById('login-form').classList.add('hidden');
                document.getElementById('register-form').classList.remove('hidden');
                document.getElementById('register-tab').classList.add('text-blue-600', 'dark:text-blue-400', 'border-b-2', 'border-blue-600', 'dark:border-blue-400');
                document.getElementById('register-tab').classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-800', 'dark:hover:text-gray-200');
                document.getElementById('login-tab').classList.remove('text-blue-600', 'dark:text-blue-400', 'border-b-2', 'border-blue-600', 'dark:border-blue-400');
                document.getElementById('login-tab').classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-800', 'dark:hover:text-gray-200');
            });
            
            // Форма входа
            document.getElementById('login-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const email = document.getElementById('login-email').value;
                const password = document.getElementById('login-password').value;
                const rememberMe = document.getElementById('remember-me').checked;
                
                const result = await login(email, password);
                
                if (result.success) {
                    // Перезагружаем страницу после успешного входа
                    window.location.reload();
                } else {
                    document.getElementById('login-error').textContent = result.error;
                    document.getElementById('login-error').classList.remove('hidden');
                }
            });
            
            // Форма регистрации
            document.getElementById('register-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const name = document.getElementById('register-name').value;
                const email = document.getElementById('register-email').value;
                const password = document.getElementById('register-password').value;
                const confirmPassword = document.getElementById('register-confirm-password').value;
                
                if (password !== confirmPassword) {
                    document.getElementById('register-error').textContent = 'Пароли не совпадают';
                    document.getElementById('register-error').classList.remove('hidden');
                    return;
                }
                
                const result = await register(name, email, password);
                
                if (result.success) {
                    document.getElementById('register-error').classList.add('hidden');
                    document.getElementById('register-success').classList.remove('hidden');
                    document.getElementById('register-form').reset();
                    
                    setTimeout(() => {
                        document.getElementById('login-tab').click();
                        document.getElementById('login-email').value = email;
                        document.getElementById('register-success').classList.add('hidden');
                    }, 2000);
                } else {
                    document.getElementById('register-error').textContent = result.error;
                    document.getElementById('register-error').classList.remove('hidden');
                }
            });
            
            // Выход из аккаунта
            document.getElementById('logout-btn').addEventListener('click', async () => {
                const result = await logout();
                if (result.success) {
                    window.location.reload();
                } else {
                    alert('Ошибка при выходе: ' + result.error);
                }
            });
            
            // Переключение темы
            document.getElementById('theme-toggle').addEventListener('click', () => {
                const html = document.documentElement;
                html.classList.toggle('dark');
                
                const theme = html.classList.contains('dark') ? 'dark' : 'light';
                localStorage.setItem('theme', theme);
            });
            
            // Переключение вкладок профиля
            document.querySelectorAll('.tab-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const tabId = button.getAttribute('data-tab');
                    
                    // Убираем активный класс у всех кнопок и содержимого
                    document.querySelectorAll('.tab-btn').forEach(btn => {
                        btn.classList.remove('bg-blue-100', 'dark:bg-blue-900', 'text-blue-800', 'dark:text-blue-200');
                        btn.classList.add('hover:bg-gray-200', 'dark:hover:bg-gray-600', 'text-gray-700', 'dark:text-gray-200');
                    });
                    
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Добавляем активный класс к текущей кнопке и содержимому
                    button.classList.add('bg-blue-100', 'dark:bg-blue-900', 'text-blue-800', 'dark:text-blue-200');
                    button.classList.remove('hover:bg-gray-200', 'dark:hover:bg-gray-600', 'text-gray-700', 'dark:text-gray-200');
                    
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Загрузка аватарки
            document.getElementById('avatar-input').addEventListener('change', async (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = async (event) => {
                        document.getElementById('avatar-preview').src = event.target.result;
                        
                        const result = await updateAvatar(<?php echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null'; ?>, event.target.result);
                        
                        if (result.success) {
                            window.location.reload();
                        } else {
                            alert('Ошибка при обновлении аватара: ' + result.error);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

// Сохранение профиля
document.getElementById('profile-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const updatedData = {
        firstName: document.getElementById('first-name').value,
        lastName: document.getElementById('last-name').value,
        phone: document.getElementById('phone').value,
        address: document.getElementById('address').value
    };
    
    try {
        const response = await fetch('profile_red.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update',
                data: updatedData
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            window.location.reload();
        } else {
            alert('Ошибка при сохранении: ' + result.error);
        }
    } catch (error) {
        console.error('Ошибка:', error);
        alert('Ошибка соединения с сервером');
    }
});

// Изменение пароля
document.getElementById('change-password-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const currentPassword = document.getElementById('current-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmNewPassword = document.getElementById('confirm-new-password').value;
    
    if (newPassword !== confirmNewPassword) {
        document.getElementById('password-change-error').textContent = 'Новые пароли не совпадают';
        document.getElementById('password-change-error').classList.remove('hidden');
        return;
    }
    
    if (newPassword.length < 6) {
        document.getElementById('password-change-error').textContent = 'Пароль должен содержать не менее 6 символов';
        document.getElementById('password-change-error').classList.remove('hidden');
        return;
    }
    
    try {
        const response = await fetch('profile_red.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'change-password',
                currentPassword: currentPassword,
                newPassword: newPassword
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            document.getElementById('change-password-modal').classList.add('hidden');
            document.getElementById('password-change-error').classList.add('hidden');
            document.getElementById('change-password-form').reset();
            alert('Пароль успешно изменен!');
            window.location.reload();
        } else {
            document.getElementById('password-change-error').textContent = result.error;
            document.getElementById('password-change-error').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Ошибка:', error);
        alert('Ошибка соединения с сервером');
    }
});

// Обновление аватара
document.getElementById('avatar-input').addEventListener('change', async (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = async (event) => {
            try {
                const response = await fetch('profile_red.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update-avatar',
                        avatar: event.target.result
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    window.location.reload();
                } else {
                    alert('Ошибка при обновлении аватара: ' + result.error);
                }
            } catch (error) {
                console.error('Ошибка:', error);
                alert('Ошибка соединения с сервером');
            }
        };
        reader.readAsDataURL(file);
    }
});

// Удаление из избранного
document.addEventListener('click', async (e) => {
    if (e.target.closest('.remove-favorite')) {
        const button = e.target.closest('.remove-favorite');
        const productId = parseInt(button.getAttribute('data-id'));
        
        if (confirm('Удалить товар из избранного?')) {
            const currentFavorites = <?php echo isset($_SESSION['user']['favorites']) ? json_encode($_SESSION['user']['favorites']) : '[]'; ?>;
            const newFavorites = currentFavorites.filter(id => id !== productId);
            
            try {
                const response = await fetch('profile_red.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update-favorites',
                        favorites: newFavorites
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    window.location.reload();
                } else {
                    alert('Ошибка при обновлении избранного: ' + result.error);
                }
            } catch (error) {
                console.error('Ошибка:', error);
                alert('Ошибка соединения с сервером');
            }
        }
    }
});
            
            // Кнопка изменения пароля
            document.getElementById('change-password-btn').addEventListener('click', () => {
                document.getElementById('change-password-modal').classList.remove('hidden');
            });
            
            // Закрытие модального окна смены пароля
            document.getElementById('close-password-modal').addEventListener('click', () => {
                document.getElementById('change-password-modal').classList.add('hidden');
                document.getElementById('password-change-error').classList.add('hidden');
                document.getElementById('change-password-form').reset();
            });
            
            document.getElementById('cancel-password-change').addEventListener('click', () => {
                document.getElementById('change-password-modal').classList.add('hidden');
                document.getElementById('password-change-error').classList.add('hidden');
                document.getElementById('change-password-form').reset();
            });
            
            // Форма смены пароля
            document.getElementById('change-password-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const currentPassword = document.getElementById('current-password').value;
                const newPassword = document.getElementById('new-password').value;
                const confirmNewPassword = document.getElementById('confirm-new-password').value;
                
                if (newPassword !== confirmNewPassword) {
                    document.getElementById('password-change-error').textContent = 'Новые пароли не совпадают';
                    document.getElementById('password-change-error').classList.remove('hidden');
                    return;
                }
                
                if (newPassword.length < 6) {
                    document.getElementById('password-change-error').textContent = 'Пароль должен содержать не менее 6 символов';
                    document.getElementById('password-change-error').classList.remove('hidden');
                    return;
                }
                
                const result = await changePassword(<?php echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null'; ?>, currentPassword, newPassword);
                
                if (result.success) {
                    document.getElementById('change-password-modal').classList.add('hidden');
                    document.getElementById('password-change-error').classList.add('hidden');
                    document.getElementById('change-password-form').reset();
                    alert('Пароль успешно изменен!');
                    window.location.reload();
                } else {
                    document.getElementById('password-change-error').textContent = result.error;
                    document.getElementById('password-change-error').classList.remove('hidden');
                }
            });
            
            // Удаление из избранного
            document.addEventListener('click', async (e) => {
                if (e.target.closest('.remove-favorite')) {
                    const button = e.target.closest('.remove-favorite');
                    const productId = parseInt(button.getAttribute('data-id'));
                    
                    if (confirm('Удалить товар из избранного?')) {
                        const currentFavorites = <?php echo isset($_SESSION['user']['favorites']) ? json_encode($_SESSION['user']['favorites']) : '[]'; ?>;
                        const newFavorites = currentFavorites.filter(id => id !== productId);
                        
                        const result = await updateFavorites(<?php echo isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null'; ?>, newFavorites);
                        
                        if (result.success) {
                            window.location.reload();
                        } else {
                            alert('Ошибка при обновлении избранного: ' + result.error);
                        }
                    }
                }
            });
            
            // Сортировка избранного
            document.getElementById('favorites-sort').addEventListener('change', () => {
                // В реальном приложении здесь была бы перезагрузка данных с сервера
                alert('В реальном приложении здесь загружались бы отсортированные данные с сервера');
            });
            
            // Кнопка "Показать еще" в избранном
            document.getElementById('load-more-favorites').addEventListener('click', () => {
                alert('В реальном приложении здесь загружались бы дополнительные товары');
            });

            // Мобильное меню
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
            });
        }
        
        // Удаление из избранного
document.addEventListener('click', async (e) => {
    if (e.target.closest('.remove-favorite')) {
        const button = e.target.closest('.remove-favorite');
        const productId = parseInt(button.getAttribute('data-id'));
        
        if (confirm('Удалить товар из избранного?')) {
            const currentFavorites = <?php echo isset($_SESSION['user']['favorites']) ? json_encode($_SESSION['user']['favorites']) : '[]'; ?>;
            const newFavorites = currentFavorites.filter(id => id !== productId);
            
            try {
                const response = await fetch('profile_red.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'update-favorites',
                        favorites: newFavorites
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    window.location.reload();
                } else {
                    alert('Ошибка при обновлении избранного: ' + result.error);
                }
            } catch (error) {
                console.error('Ошибка:', error);
                alert('Ошибка соединения с сервером');
            }
        }
    }
});

// Добавление в избранное (если у вас есть такая функциональность)
document.addEventListener('click', async (e) => {
    if (e.target.closest('.add-favorite')) {
        const button = e.target.closest('.add-favorite');
        const productId = parseInt(button.getAttribute('data-id'));
        
        const currentFavorites = <?php echo isset($_SESSION['user']['favorites']) ? json_encode($_SESSION['user']['favorites']) : '[]'; ?>;
        if (currentFavorites.includes(productId)) {
            alert('Этот товар уже в избранном');
            return;
        }
        
        const newFavorites = [...currentFavorites, productId];
        
        try {
            const response = await fetch('profile_red.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'update-favorites',
                    favorites: newFavorites
                })
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert('Товар добавлен в избранное!');
                window.location.reload();
            } else {
                alert('Ошибка при добавлении в избранное: ' + result.error);
            }
        } catch (error) {
            console.error('Ошибка:', error);
            alert('Ошибка соединения с сервером');
        }
    }
});
    </script>
</body>
</html>