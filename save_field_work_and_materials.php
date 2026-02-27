<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $work_order_id = $_POST['work_order_id'];

    try {
        $pdo->beginTransaction(); // بدء المعاملة لضمان حفظ البيانات المترابطة

        // 1. حفظ بيانات الحفر
        $stmt1 = $pdo->prepare("INSERT INTO field_works (work_order_id, digging_start_date, digging_end_date) VALUES (?, ?, ?)");
        $stmt1->execute([$work_order_id, $_POST['digging_start_date'], $_POST['digging_end_date']]);

        // 2. حفظ المواد المحجوزة
        $stmt2 = $pdo->prepare("INSERT INTO warehouse_logs (work_order_id, material_code, material_name, qty_from_electricity) VALUES (?, ?, ?, ?)");

        foreach ($_POST['m_code'] as $index => $code) {
            $name = $_POST['m_name'][$index];
            $qty = $_POST['m_qty'][$index];
            $stmt2->execute([$work_order_id, $code, $name, $qty]);
        }

        $pdo->commit(); // اعتماد الحفظ النهائي
        header("Location: admin_dashboard.php?msg=field_saved");

    } catch (Exception $e) {
        $pdo->rollBack(); // التراجع في حال حدوث أي خطأ
        die("خطأ في الحفظ الميداني: " . $e->getMessage());
    }
}