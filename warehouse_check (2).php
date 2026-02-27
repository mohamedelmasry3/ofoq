<?php
require_once 'db_config.php';
session_start();

// جلب المشاريع التي وصلت لمرحلة "المستودع والمطابقة"
$sql = "SELECT id, work_order_no FROM assignments WHERE current_stage = 'المستودع والمطابقة'";
$projects = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مطابقة كميات المستودع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .deficit-bg { background-color: #fff3f3; }
        .success-bg { background-color: #f3fff3; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 pb-5">
    <div class="card shadow border-0">
        <div class="card-header bg-secondary text-white text-center py-3">
            <h4><i class="fas fa-boxes-stacked me-2"></i> المرحلة 5: مطابقة كميات المستودع وحساب العجز</h4>
        </div>
        <div class="card-body p-4">
            <form action="save_warehouse_check.php" method="POST">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">اختر المشروع للمطابقة:</label>
                        <select name="work_order_id" id="project_select" class="form-select form-select-lg" required>
                            <option value="">-- اختر أمر العمل --</option>
                            <?php foreach ($projects as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= $p['work_order_no'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center" id="matching_table">
                        <thead class="table-dark">
                            <tr>
                                <th>اسم المادة / الكود</th>
                                <th width="20%">كمية شركة الكهرباء</th>
                                <th width="20%">كمية شركة أفق (المنفذة)</th>
                                <th width="20%">مقدار العجز</th>
                            </tr>
                        </thead>
                        <tbody id="materials_rows">
                            <tr><td colspan="4" class="text-muted">اختر مشروعاً لعرض المواد المحجوزة</td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="mb-4 mt-4">
                    <label class="form-label fw-bold">ملاحظات المستودع حول العجز أو الهالك:</label>
                    <textarea name="warehouse_notes" class="form-control" rows="3"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-dark btn-lg px-5 shadow">اعتماد المطابقة والانتقال للمستخلصات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// كود AJAX بسيط لجلب المواد المحجوزة عند اختيار المشروع (يمكنك تفعيله لاحقاً)
// للتبسيط حالياً سنسمح بإضافة المواد يدوياً أو برمجياً
</script>

</body>
</html>