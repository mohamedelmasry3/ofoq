<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_id = $_POST['work_order_id'];
    $install_date = $_POST['installation_date'];
    $cable_length = $_POST['cable_length'];
    $notes = $_POST['elec_notes'];

    // معالجة رفع الصور
    $photo_paths = [];
    if (!empty($_FILES['elec_photos']['name'][0])) {
        $upload_dir = 'uploads/electrical/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        foreach ($_FILES['elec_photos']['tmp_name'] as $key => $tmp_name) {
            $file_name = time() . '_' . $_FILES['elec_photos']['name'][$key];
            if (move_uploaded_file($tmp_name, $upload_dir . $file_name)) {
                $photo_paths[] = $file_name;
            }
        }
    }
    $photos_string = implode(',', $photo_paths);

    try {
        $pdo->beginTransaction();

        // 1. تحديث بيانات الكهرباء (بافتراض وجود الأعمدة أو جدول منفصل)
        // هنا سنحدث جدول assignments لتغيير المرحلة وإضافة الملاحظات والصور
        $sql = "UPDATE assignments 
                SET current_stage = 'المستودع والمطابقة', 
                    electrical_notes = ?, 
                    electrical_photos = ? 
                WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$notes, $photos_string, $wo_id]);

        $pdo->commit();
        header("Location: index.php?success=elec_saved");
    } catch (Exception $e) {
        $pdo->rollBack();
        die("خطأ في الحفظ: " . $e->getMessage());
    }
}