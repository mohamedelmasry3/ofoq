<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_id = $_POST['work_order_id'];
    $notes = $_POST['warehouse_notes'];
    
    // بيانات المواد (مصفوفات)
    $material_codes = $_POST['mat_code'];
    $qty_elec = $_POST['qty_elec'];
    $qty_ofoq = $_POST['qty_ofoq'];

    try {
        $pdo->beginTransaction();

        $sql = "INSERT INTO warehouse_logs (work_order_id, material_code, qty_from_electricity, qty_from_company) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        foreach ($material_codes as $i => $code) {
            $stmt->execute([$wo_id, $code, $qty_elec[$i], $qty_ofoq[$i]]);
        }

        // تحديث حالة المشروع للمرحلة الأخيرة
        $update = $pdo->prepare("UPDATE assignments SET current_stage = 'الأسفلت والمستخلصات' WHERE id = ?");
        $update->execute([$wo_id]);

        $pdo->commit();
        header("Location: index.php?success=warehouse_done");
    } catch (Exception $e) {
        $pdo->rollBack();
        die("خطأ في المطابقة: " . $e->getMessage());
    }
}