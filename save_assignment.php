<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wo_no = $_POST['work_order_no'];
    $consultant = $_POST['consultant_office'];
    $branch_id = $_POST['branch_id'];
    $receive_date = $_POST['receive_date'];
    $stage = $_POST['current_stage']; // المرحلة التي سيبدأ منها

    try {
        $sql = "INSERT INTO assignments (work_order_no, consultant_office, branch_id, receive_date, current_stage) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$wo_no, $consultant, $branch_id, $receive_date, $stage]);

        header("Location: admin_dashboard.php?success=1");
    } catch (Exception $e) {
        die("خطأ أثناء إضافة أمر العمل: " . $e->getMessage());
    }
}