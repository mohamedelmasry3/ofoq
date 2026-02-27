<?php
require_once 'db_config.php';

// جلب المشاريع التي وصلت لمرحلة الأسفلت
$projects = $pdo->query("SELECT id, work_order_no FROM assignments WHERE current_stage = 'الأسفلت'")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إغلاق المشروع والمستخلصات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow border-success">
            <div class="card-header bg-success text-white">
                <h4><i class="fas fa-road"></i> الخطوة 6: إغلاق الموقع ورفع المستخلص النهائي</h4>
            </div>
            <div class="card-body">
                <form action="save_final_stage.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">اختر المشروع للإغلاق:</label>
                        <select name="work_order_id" class="form-select" required>
                            <option value="">-- اختر المشروع --</option>
                            <?php foreach ($projects as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= $p['work_order_no'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row bg-light p-3 rounded mb-3">
                        <h6 class="text-success border-bottom pb-2">بيانات إعادة الحالة (الأسفلت):</h6>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">تاريخ الانتهاء من السفلتة:</label>
                            <input type="date" name="asphalt_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم بيان السفلتة:</label>
                            <input type="text" name="asphalt_statement_no" class="form-control" placeholder="رقم البيان الصادر">
                        </div>
                    </div>

                    <div class="row bg-white p-3 border rounded">
                        <h6 class="text-primary border-bottom pb-2">بيانات المستخلص المالي:</h6>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">كود المستخلص (Extract Code):</label>
                            <input type="text" name="extract_code" class="form-control" required placeholder="مثال: EXT-2026-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">تاريخ رفع المستخلص:</label>
                            <input type="date" name="extract_date" class="form-control" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">رابط صورة المستخلص المختوم (PDF/Scan):</label>
                            <input type="url" name="extract_url" class="form-control" placeholder="رابط المستند على Cloud">
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-muted small">بضغطك على إغلاق، سيتم أرشفة المشروع كـ "منتهٍ" في التقارير.</p>
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow">إغلاق المشروع نهائياً ✅</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>