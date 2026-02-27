<?php
require 'db_config.php';

// كلمة المرور الجديدة التي تريدها
$new_password = 'admin'; 

// تشفير الكلمة بطريقة BCrypt التي يتوقعها ملف login_process
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ?, is_active = TRUE WHERE username = 'admin'");
    $stmt->execute([$hashed_password]);
    echo "تم تحديث كلمة المرور بنجاح! جرب الدخول الآن بـ: admin / admin";
} catch (Exception $e) {
    echo "خطأ: " . $e->getMessage();
}
?>