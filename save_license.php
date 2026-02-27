<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field_id     = $_POST['field_work_id'];
    $license_no   = $_POST['license_no'];
    $type         = $_POST['license_type'];
    $start        = $_POST['start_date'];
    $end          = $_POST['end_date'];

    try {
        $sql = "INSERT INTO digging_licenses (field_work_id, license_no, license_type, start_date, end_date)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$field_id, $license_no, $type, $start, $end]);

        header("Location: admin_dashboard.php?msg=license_added");
        exit();

    } catch (PDOException $e) {
        die("خطأ في حفظ الرخصة: " . $e->getMessage());
    }
}