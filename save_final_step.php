<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_id = $_POST['work_order_id'];
    $extract_no = $_POST['extract_no'];
    $asphalt_date = $_POST['asphalt_date'];

    // معالجة رفع صورة الأسفلت
    $final_photo_name = "";
    if (!empty($_FILES['final_photo']['name'])) {
        $target_dir = "uploads/final/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $final_photo_name = time() . "_" . basename($_FILES["final_photo"]["name"]);
        move_uploaded_file($_FILES["final_photo"]["tmp_name"], $target_dir . $final_photo_name);
    }

    try {
        $pdo->beginTransaction();

        // تحديث البيانات وحالة المشروع النهائية
        $sql = "UPDATE assignments 
                SET current_stage = 'مكتمل ومؤرشف', 
                    final_extract_no = ?, 
                    asphalt_date = ?, 
                    final_photo = ? 
                WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$extract_no, $asphalt_date, $final_photo_name, $wo_id]);

        $pdo->commit();
        header("Location: index.php?success=project_archived");
    } catch (Exception $e) {
        $pdo->rollBack();
        die("خطأ في الأرشفة: " . $e->getMessage());
    }
}