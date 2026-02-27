<?php
require 'db_config.php';

$stmt = $pdo->prepare("SELECT username, password_hash FROM users WHERE username = 'admin'");
$stmt->execute();
$user = $stmt->fetch();

if ($user) {
    echo "اسم المستخدم في القاعدة: [" . $user['username'] . "] (الطول: " . strlen($user['username']) . ")<br>";
    echo "كلمة المرور في القاعدة: [" . $user['password_hash'] . "] (الطول: " . strlen($user['password_hash']) . ")<br>";
    
    if ($user['password_hash'] === '123') {
        echo "<h3 style='color:green;'>المطابقة اليدوية نجحت! المشكلة في كود login_process</h3>";
    } else {
        echo "<h3 style='color:red;'>المطابقة اليدوية فشلت! القيمة في القاعدة ليست 123 تماماً</h3>";
    }
} else {
    echo "المستخدم غير موجود أصلاً!";
}
?>