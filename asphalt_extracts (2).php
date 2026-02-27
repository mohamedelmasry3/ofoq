<?php
require_once 'db_config.php';
session_start();

// جلب المشاريع التي وصلت للمرحلة النهائية
$sql = "SELECT id, work_order_no, consultant_office FROM assignments WHERE current_stage = 'الأسفلت والمستخلصات'";
$projects = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الأسفلت والمستخلصات النهائية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white text-center py-3">
            <h4><i class="fas fa-check-double me-2"></i> المرحلة 6: الأسفلت وإغلاق المستخلص المالي</h4>
        </div>
        <div class="card-body p-4">
            <form action="save_final_step.php" method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="form-label fw-bold">اختر المشروع للإغلاق النهائي:</label>
                    <select name="work_order_id" class="form-select form-select-lg" required>
                        <option value="">-- اختر أمر العمل --</option>
                        <?php foreach ($projects as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['work_order_no'] ?> (<?= $p['consultant_office'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">تاريخ الانتهاء من السفلتة:</label>
                        <input type="date" name="asphalt_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">رقم المستخلص النهائي:</label>
                        <input type="text" name="extract_no" class="form-control" placeholder="مثلاً: INV-2026-001">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">رفع صورة الموقع بعد السفلتة (التسليم النهائي):</label>
                    <input type="file" name="final_photo" class="form-control" accept="image/*">
                </div>

                <div class="mb-4 text-center p-3 bg-light rounded border">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="confirm_asphalt" required>
                        <label class="form-check-label fw-bold text-success" for="confirm_asphalt">أقر بصحة البيانات وإتمام السفلتة والمطالبة المالية</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow">إغلاق المشروع وأرشفته <i class="fas fa-archive ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>