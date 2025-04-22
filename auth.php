<?php
header('Content-Type: application/json');
session_start();

// Путь к файлу с пользователями
$usersFile = 'users.json';

// Функция для чтения пользователей из файла
function getUsers() {
    global $usersFile;
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, '[]');
        return [];
    }
    $content = file_get_contents($usersFile);
    return json_decode($content, true) ?: [];
}

// Функция для сохранения пользователей в файл
function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);

// Обработка разных действий
$action = $data['action'] ?? '';

switch ($action) {
    case 'login':
        $users = getUsers();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        
        $user = null;
        foreach ($users as $u) {
            if ($u['email'] === $email && $u['password'] === $password) {
                $user = $u;
                break;
            }
        }
        
        if ($user) {
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Неверный email или пароль']);
        }
        break;
        
    case 'register':
        $users = getUsers();
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        
        // Проверяем, существует ли пользователь
        foreach ($users as $u) {
            if ($u['email'] === $email) {
                echo json_encode(['success' => false, 'error' => 'Пользователь с таким email уже существует']);
                exit;
            }
        }
        
        // Создаем нового пользователя
        $newUser = [
            'id' => uniqid(),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'firstName' => explode(' ', $name)[0] ?? '',
            'lastName' => explode(' ', $name)[1] ?? '',
            'avatar' => 'https://via.placeholder.com/128',
            'favorites' => [],
            'ordersCount' => 0,
            'bonusPoints' => 0,
            'joinDate' => date('Y-m-d'),
            'passwordChangeDate' => null,
            'phone' => '',
            'address' => ''
        ];
        
        $users[] = $newUser;
        saveUsers($users);
        
        $_SESSION['user'] = $newUser;
        echo json_encode(['success' => true, 'user' => $newUser]);
        break;
        
 case 'logout':
    // Уничтожаем все данные сессии
    $_SESSION = array();
    
    // Если требуется уничтожить cookie сессии
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Уничтожаем сессию
    session_destroy();
    
    echo json_encode(['success' => true]);
    break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Неизвестное действие']);
}
?>