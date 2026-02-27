<?php
// استخدم البيانات من Render
$host     = "your-db-hostname.render.com"; // المضيف
$dbname   = "ofoq_db";                     // اسم القاعدة
$user     = "your_username";               // اسم المستخدم
$password = "your_password";               // كلمة المرور

try {
    // ملاحظة: Render يتطلب sslmode=require للاتصال الخارجي والداخلي
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("خطأ في الاتصال بالسيرفر: " . $e->getMessage());
}
