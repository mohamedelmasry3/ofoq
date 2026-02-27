<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_id       = $_POST['work_order_id'];
    $start       = $_POST['start_date'];
    $end         = $_POST['end_date'];
    $name        = $_POST['electrician_name'];
    $url         = $_POST['photos_url'];
    $notes       = $_POST['tech_notes'];

    try {
        $pdo->beginTransaction();

        // 1. إدخال بيانات الكهرباء
        $sql = "INSERT INTO electrical_works (work_order_id, start_date, end_date, electrician_name, photos_url, tech_notes)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$wo_id, $start, $end, $name, $url, $notes]);

        // 2. تحديث حالة المشروع إلى "المستودع"
        $update = $pdo->prepare("UPDATE assignments SET current_stage = 'المستودع' WHERE id = ?");
        $update->execute([$wo_id]);

        $pdo->commit();
        header("Location: admin_dashboard.php?msg=electrical_done");

    } catch (Exception $e) {
        $pdo->rollBack();
        die("خطأ في حفظ بيانات الكهرباء: " . $e->getMessage());
    }
}