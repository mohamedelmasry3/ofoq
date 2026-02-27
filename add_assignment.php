<?php
session_start();
require_once 'db_config.php';

// جلب الفروع لتعبئة القائمة المنسدلة في النموذج
$sql_branches = "SELECT id, branch_name, parent_region FROM branches ORDER BY parent_region, branch_name";
$all_branches = $pdo->query($sql_branches)->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إسناد أمر عمل جديد - نظام أفق</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/all.min.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .main-card { border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.1); background: #fff; }
        .section-title { border-right: 5px solid #0d6efd; padding-right: 15px; margin-bottom: 20px; color: #0d6efd; font-weight: bold; }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card main-card p-4 p-md-5">
                <h2 class="text-center mb-5 text-primary">إضافة وإسناد أمر عمل جديد</h2>
                
                <form action="save_assignment.php" method="POST" enctype="multipart/form-data">
                    <h5 class="section-title">البيانات الأساسية</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">رقم أمر العمل الجديد:</label>
                            <input type="text" name="work_order_no" class="form-control" placeholder="مثال: WO-2026-001" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">مكتب الاستشاري:</label>
                            <input type="text" name="consultant_office" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">تاريخ التعميد:</label>
                            <input type="date" name="receive_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <h5 class="section-title">تحديد المسار (الإسناد)</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">الفرع المسؤول:</label>
                            <select name="branch_id" class="form-select" required>
                                <option value="">-- اختر الفرع --</option>
                                <?php foreach ($all_branches as $region => $branches): ?>
                                    <optgroup label="منطقة: <?= $region ?>">
                                        <?php foreach ($branches as $branch): ?>
                                            <option value="<?= $branch['id'] ?>"><?= $branch['branch_name'] ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الحالة الأولية:</label>
                            <select name="current_stage" class="form-select bg-light text-primary fw-bold">
                                <option value="الميدان">توجيه للميدان فوراً</option>
                                <option value="الإسناد" selected>بانتظار المراجعة (الإسناد)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5">
                        <a href="admin_dashboard.php" class="btn btn-outline-secondary px-5 rounded-pill">إلغاء</a>
                        <button type="submit" class="btn btn-primary px-5 shadow rounded-pill">إنشاء وتوزيع الطلب <i class="fas fa-paper-plane ms-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>