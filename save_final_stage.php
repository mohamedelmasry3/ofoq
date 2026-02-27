<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_id = $_POST['work_order_id'];

    try {
        $pdo->beginTransaction();

        // 1. حفظ بيانات الأسفلت
        $stmt1 = $pdo->prepare("INSERT INTO asphalt_works (work_order_id, asphalt_date, statement_no) VALUES (?, ?, ?)");
        $stmt1->execute([$wo_id, $_POST['asphalt_date'], $_POST['asphalt_statement_no']]);

        // 2. حفظ بيانات المستخلص
        $stmt2 = $pdo->prepare("INSERT INTO extracts (work_order_id, extract_code, extract_date, extract_url) VALUES (?, ?, ?, ?)");
        $stmt2->execute([$wo_id, $_POST['extract_code'], $_POST['extract_date'], $_POST['extract_url']]);

        // 3. تحديث حالة المشروع النهائية وتحديد تاريخ التسكير (completion_date)
        $update = $pdo->prepare("UPDATE assignments SET current_stage = 'منتهٍ', completion_date = NOW() WHERE id = ?");
        $update->execute([$wo_id]);

        $pdo->commit();
        header("Location: admin_dashboard.php?msg=project_closed");

    } catch (Exception $e) {
        $pdo->rollBack();
        die("خطأ في إغلاق المشروع: " . $e->getMessage());
    }
}