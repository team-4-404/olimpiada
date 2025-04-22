<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'error' => 'Необходима авторизация']);
    exit;
}

$usersFile = 'users.json';

function getUsers() {
    global $usersFile;
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, '[]');
        return [];
    }
    $content = file_get_contents($usersFile);
    return json_decode($content, true) ?: [];
}

function saveUsers($users) {
    global $usersFile;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';
$userId = $_SESSION['user']['id'];

switch ($action) {
    case 'update':
        $users = getUsers();
        $updatedData = $data['data'] ?? [];
        
        $changesMade = false;
        
        foreach ($users as &$user) {
            if ($user['id'] === $userId) {
                // Обновляем только разрешенные поля
                $allowedFields = ['firstName', 'lastName', 'phone', 'address'];
                foreach ($allowedFields as $field) {
                    if (isset($updatedData[$field]) && $user[$field] !== $updatedData[$field]) {
                        $user[$field] = $updatedData[$field];
                        $changesMade = true;
                    }
                }
                
                // Обновляем полное имя, если изменилось имя или фамилия
                if ((isset($updatedData['firstName']) || isset($updatedData['lastName'])) && 
                    ($user['name'] !== trim($user['firstName'] . ' ' . $user['lastName']))) {
                    $user['name'] = trim($user['firstName'] . ' ' . $user['lastName']);
                    $changesMade = true;
                }
                
                if ($changesMade) {
                    saveUsers($users);
                    $_SESSION['user'] = $user;
                    echo json_encode(['success' => true, 'user' => $user]);
                } else {
                    echo json_encode(['success' => true, 'noChanges' => true]);
                }
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Пользователь не найден']);
        break;
        
    case 'change-password':
        $users = getUsers();
        $currentPassword = $data['currentPassword'] ?? '';
        $newPassword = $data['newPassword'] ?? '';
        
        foreach ($users as &$user) {
            if ($user['id'] === $userId) {
                if ($user['password'] !== $currentPassword) {
                    echo json_encode(['success' => false, 'error' => 'Текущий пароль неверен']);
                    exit;
                }
                
                if ($user['password'] === $newPassword) {
                    echo json_encode(['success' => true, 'noChanges' => true]);
                    exit;
                }
                
                $user['password'] = $newPassword;
                $user['passwordChangeDate'] = date('Y-m-d');
                saveUsers($users);
                $_SESSION['user'] = $user;
                echo json_encode(['success' => true, 'user' => $user]);
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Пользователь не найден']);
        break;
        
    case 'update-avatar':
        $users = getUsers();
        $avatar = $data['avatar'] ?? '';
        
        foreach ($users as &$user) {
            if ($user['id'] === $userId) {
                if ($user['avatar'] === $avatar) {
                    echo json_encode(['success' => true, 'noChanges' => true]);
                    exit;
                }
                
                $user['avatar'] = $avatar;
                saveUsers($users);
                $_SESSION['user'] = $user;
                echo json_encode(['success' => true, 'user' => $user]);
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Пользователь не найден']);
        break;
        
    case 'update-favorites':
        $users = getUsers();
        $favorites = $data['favorites'] ?? [];
        
        foreach ($users as &$user) {
            if ($user['id'] === $userId) {
                // Проверяем, есть ли изменения
                $currentFavorites = $user['favorites'] ?? [];
                if (count(array_diff($currentFavorites, $favorites)) === 0 && count(array_diff($favorites, $currentFavorites)) === 0) {
                    echo json_encode(['success' => true, 'noChanges' => true]);
                    exit;
                }
                
                $user['favorites'] = $favorites;
                saveUsers($users);
                $_SESSION['user'] = $user;
                echo json_encode(['success' => true, 'user' => $user]);
                exit;
            }
        }
        
        echo json_encode(['success' => false, 'error' => 'Пользователь не найден']);
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Неизвестное действие']);
}