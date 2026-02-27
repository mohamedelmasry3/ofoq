<?php 
include 'check_auth.php'; 
require_once 'db_config.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إسناد ومعاينة مشروع | شركة أفق</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .form-card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .section-header { color: #1e3c72; border-bottom: 2px solid #1e3c72; padding-bottom: 8px; margin-bottom: 20px; font-weight: bold; }
        .btn-add { border-radius: 20px; padding: 5px 20px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card form-card">
        <div class="card-header bg-primary text-white p-3 text-center">
            <h4 class="mb-0">تعبئة بيانات إسناد الميدان والمعاينة</h4>
        </div>
        <div class="card-body p-4">
            <form action="save_assignment.php" method="POST" enctype="multipart/form-data">
                
                <h5 class="section-header"><i class="fas fa-file-invoice me-2"></i> معلومات الاستلام الأساسية</h5>
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">رقم أمر العمل (Work Order)</label>
                        <input type="text" name="work_order_no" class="form-control" required placeholder="مثال: WO-9988">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">مكتب الاستشاري</label>
                        <input type="text" name="consultant_office" class="form-control" required placeholder="اسم المكتب الاستشاري">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">تاريخ الاستلام</label>
                        <input type="date" name="receive_date" class="form-control" required value="<?= date('Y-m-d') ?>">
                    </div>
                </div>

                <h5 class="section-header"><i class="fas fa-microscope me-2"></i> تفاصيل المعاينة الفنية</h5>
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">مهندس المعاينة الميداني</label>
                        <input type="text" name="survey_engineer" class="form-control" placeholder="اسم المهندس">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">تاريخ المعاينة</label>
                        <input type="date" name="survey_date" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">مرفقات الاستلام (PDF/صور)</label>
                        <input type="file" name="attachments[]" class="form-control" multiple>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">ملاحظات المعاينة الفنية</label>
                        <textarea name="survey_notes" class="form-control" rows="3" placeholder="اكتب أي ملاحظات تم رصدها في الموقع..."></textarea>
                    </div>
                </div>

                <h5 class="section-header text-success"><i class="fas fa-cubes me-2"></i> حجز المواد (أصناف متعددة)</h5>
                <div id="materials-container">
                    <div class="row g-2 mb-2 material-row">
                        <div class="col-md-8">
                            <input type="text" name="material_name[]" class="form-control" placeholder="اسم الصنف / المادة">
                        </div>
                        <div class="col-md-3">
                            <input type="number" step="0.01" name="material_qty[]" class="form-control" placeholder="الكمية">
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-outline-danger w-100" onclick="removeMaterial(this)"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-success btn-sm btn-add mt-2" onclick="addMaterial()">
                    <i class="fas fa-plus-circle me-1"></i> إضافة صنف مادة آخر
                </button>

                <hr class="my-5">

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">حفظ وإتمام عملية الإسناد</button>
                    <a href="admin_dashboard.php" class="btn btn-link text-muted">إلغاء والعودة</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// وظيفة إضافة صف مادة جديد
function addMaterial() {
    const container = document.getElementById('materials-container');
    const newRow = document.querySelector('.material-row').cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = ''); // تصفير الحقول المنسوخة
    container.appendChild(newRow);
}

// وظيفة حذف صف المادة
function removeMaterial(button) {
    const rows = document.querySelectorAll('.material-row');
    if (rows.length > 1) {
        button.closest('.material-row').remove();
    } else {
        alert('يجب وجود صنف واحد على الأقل أو تركه فارغاً');
    }
}
</script>

</body>
</html>