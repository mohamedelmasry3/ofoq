<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_id = $_POST['work_order_id'];
    $qty_company = $_POST['qty_company']; // مصفوفة تحتوي على (id السجل => الكمية)

    try {
        $pdo->beginTransaction();

        $sql = "UPDATE warehouse_logs SET qty_from_company = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        foreach ($qty_company as $log_id => $qty) {
            $stmt->execute([$qty, $log_id]);
        }

        // تحديث مرحلة المشروع إلى "الأسفلت"
        $update = $pdo->prepare("UPDATE assignments SET current_stage = 'الأسفلت' WHERE id = ?");
        $update->execute([$wo_id]);

        $pdo->commit();
        header("Location: admin_dashboard.php?msg=reconciliation_complete");

    } catch (Exception $e) {
        $pdo->rollBack();
        die("خطأ في مطابقة المستودع: " . $e->getMessage());
    }
}