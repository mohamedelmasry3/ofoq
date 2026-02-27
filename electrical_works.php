<?php
require_once 'db_config.php';

// جلب المشاريع التي حالتها حالياً "أعمال الكهرباء"
$sql = "SELECT id, work_order_no FROM assignments WHERE current_stage = 'أعمال الكهرباء' ORDER BY id DESC";
$electric_projects = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة أعمال الكهرباء</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow border-warning">
            <div class="card-header bg-warning text-dark">
                <h4><i class="fas fa-bolt"></i> الخطوة 4: تسجيل إنجاز أعمال الكهرباء</h4>
            </div>
            <div class="card-body">
                <form action="save_electrical.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">مشروع الكهرباء الجاري:</label>
                        <select name="work_order_id" class="form-select" required>
                            <option value="">-- اختر المشروع --</option>
                            <?php foreach ($electric_projects as $project): ?>
                                <option value="<?= $project['id'] ?>"><?= $project['work_order_no'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">تاريخ بداية التمديدات:</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">تاريخ الانتهاء من الكهرباء:</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">اسم فني/مقاول الكهرباء:</label>
                        <input type="text" name="electrician_name" class="form-control" placeholder="المسؤول عن التنفيذ">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">رابط صور التنفيذ (Cloud):</label>
                        <input type="url" name="photos_url" class="form-control" placeholder="رابط صور الكابلات والمحولات">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ملاحظات فنية:</label>
                        <textarea name="tech_notes" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning px-5 fw-bold">حفظ وإرسال للمستودع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>