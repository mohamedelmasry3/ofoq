<?php
$host = "localhost";
$port = "5432";
$dbname = "ofoq"; // تم تعديله بناءً على تعليقك
$user = "postgres";
$password = "0207"; // تم تعديله بناءً على تعليقك

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    // في حال فشل الاتصال، سيظهر لك السبب الدقيق
    die("خطأ في الاتصال بالقاعدة: " . $e->getMessage());
}
?>