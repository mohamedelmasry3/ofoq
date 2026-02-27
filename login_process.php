<?php
session_start();
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // البحث عن المستخدم مع تنظيف المسافات في القاعدة أيضاً
        $stmt = $pdo->prepare("SELECT * FROM users WHERE LOWER(TRIM(username)) = LOWER(:user) AND is_active = TRUE");
        $stmt->execute(['user' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            // مقارنة كلمة المرور (استخدمنا trim للمخزن في القاعدة لضمان التطابق)
            if ($password === trim($user['password_hash'])) {
                
                // تسجيل بيانات الجلسة
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role_type'];
                $_SESSION['full_name'] = $user['full_name'];

                // التوجيه للرئيسية
                header("Location: index.php");
                exit();
            } else {
                echo "كلمة المرور غير صحيحة.";
            }
        } else {
            echo "اسم المستخدم غير موجود أو الحساب غير نشط.";
        }
    } catch (PDOException $e) {
        echo "خطأ في قاعدة البيانات: " . $e->getMessage();
    }
}
?>