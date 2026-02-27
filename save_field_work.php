<?php
session_start();
require 'db_config.php';

// التأكد من أن المستخدم لديه صلاحية (أدمن أو تخصص ميداني)
if ($_SESSION['specialty'] !== 'Field_Work' && $_SESSION['role'] !== 'Admin') {
    die("ليس لديك صلاحية للإدخال في هذه الشاشة.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "INSERT INTO field_works (
                    work_order_id,
                    digging_start_date,
                    digging_end_date,
                    digging_manager,
                    consultant_eng_name,
                    consultant_eng_phone
                ) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['work_order_id'],
            $_POST['digging_start_date'],
            $_POST['digging_end_date'],
            $_POST['digging_manager'],
            $_POST['consultant_eng_name'],
            $_POST['consultant_eng_phone']
        ]);

        echo "<script>alert('تم حفظ البيانات الميدانية بنجاح!'); window.location='dashboard.php';</script>";

    } catch (PDOException $e) {
        // إذا حاول الموظف إدخال بيانات لنفس أمر العمل مرتين (بسبب القيد UNIQUE)
        if ($e->getCode() == 23505) {
            echo "خطأ: بيانات هذا المشروع مدخلة مسبقاً في النظام الميداني.";
        } else {
            echo "خطأ فني: " . $e->getMessage();
        }
    }
}
?>