<?php
require_once 'db_config.php';
session_start();

// جلب المشاريع التي في مرحلة أعمال الكهرباء
$sql = "SELECT id, work_order_no FROM assignments WHERE current_stage = 'أعمال الكهرباء'";
$work_orders = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>أعمال الكهرباء والتوثيق</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white text-center py-3">
            <h4><i class="fas fa-bolt me-2 text-warning"></i> الخطوة 4: توثيق أعمال الكهرباء والتمديدات</h4>
        </div>
        <div class="card-body p-4">
            <form action="save_electrical_works.php" method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="form-label fw-bold">اختر أمر العمل المفتوح:</label>
                    <select name="work_order_id" class="form-select form-select-lg" required>
                        <option value="">-- اختر المشروع --</option>
                        <?php foreach ($work_orders as $wo): ?>
                            <option value="<?= $wo['id'] ?>"><?= $wo['work_order_no'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">تاريخ التمديد الفعلي:</label>
                        <input type="date" name="installation_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">طول الكابل الممدد (بالمتر):</label>
                        <input type="number" step="0.01" name="cable_length" class="form-control" placeholder="0.00">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">صور التوثيق الفني (كابلات، محولات، توصيلات):</label>
                    <input type="file" name="elec_photos[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted text-end d-block mt-1">يمكنك اختيار أكثر من صورة معاً</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">ملاحظات المهندس الكهربائي:</label>
                    <textarea name="elec_notes" class="form-control" rows="3" placeholder="أدخل أي تفاصيل فنية عن التوصيلات..."></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-warning btn-lg px-5 fw-bold">حفظ بيانات الكهرباء والدفع للمطابقة</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>