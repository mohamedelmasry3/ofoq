<?php
require 'db_config.php';

echo "<h3>جاري فحص وإصلاح نظام الدخول...</h3>";

try {
    // 1. تشفير كلمة المرور "123"
    $pass = password_hash('123', PASSWORD_BCRYPT);

    // 2. تحديث أو إدخال مستخدم المدير
    $sql = "UPDATE users SET password_hash = ?, is_active = TRUE, role_type = 'Admin' WHERE username = 'admin'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pass]);

    if ($stmt->rowCount() > 0) {
        echo "<p style='color:green;'>✅ تم تحديث بيانات المستخدم 'admin' بنجاح.</p>";
    } else {
        // إذا لم يكن موجوداً أصلاً، نقوم بإضافته
        $ins = $pdo->prepare("INSERT INTO users (username, password_hash, role_type, is_active) VALUES ('admin', ?, 'Admin', TRUE)");
        $ins->execute([$pass]);
        echo "<p style='color:green;'>✅ تم إنشاء مستخدم جديد 'admin' بنجاح.</p>";
    }

    echo "<b>الآن جرب الدخول بـ:</b><br>اسم المستخدم: admin<br>كلمة المرور: 123";

} catch (Exception $e) {
    echo "<p style='color:red;'>❌ فشل الإصلاح بسبب: " . $e->getMessage() . "</p>";
}
?>