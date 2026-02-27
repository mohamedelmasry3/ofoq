<?php
session_start();
require_once 'db_config.php';

// استعلام متقدم يجلب بيانات الإسناد ويربطها ببيانات الأعمال المدنية (الحفر) إذا وجدت
$sql = "SELECT 
            a.id, a.work_order_no, a.consultant_office, a.survey_engineer, a.current_stage,
            f.digging_start_date, f.digging_end_date, f.digging_manager, f.consultant_eng_name
        FROM assignments a
        LEFT JOIN field_works f ON a.id = f.work_order_id
        WHERE a.current_stage IN ('الميدان', 'أعمال الكهرباء')
        ORDER BY a.id DESC";

$stmt = $pdo->query($sql);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>شاشة متابعة الأعمال الميدانية والمدنية</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .table-card { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.08); background: #fff; }
        .table thead { background: #0d6efd; color: white; }
        .stage-badge { border-radius: 50px; padding: 5px 12px; font-size: 0.75rem; }
        .civil-info { font-size: 0.85rem; color: #666; }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-3">
        <h3 class="fw-bold text-primary"><i class="fas fa-hard-hat me-2"></i> متابعة الأعمال الميدانية والمدنية</h3>
        <a href="add_assignment.php" class="btn btn-success rounded-pill shadow-sm"><i class="fas fa-plus"></i> إسناد جديد</a>
    </div>

    <div class="card table-card p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>رقم الأمر</th>
                        <th>بيانات الإسناد</th>
                        <th>الأعمال المدنية (الحفر)</th>
                        <th>الاستشاري المشرف</th>
                        <th>المرحلة الحالية</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td class="fw-bold text-dark">#<?= htmlspecialchars($task['work_order_no']) ?></td>
                        
                        <td>
                            <div class="fw-bold"><?= htmlspecialchars($task['consultant_office']) ?></div>
                            <small class="text-muted">المهندس: <?= htmlspecialchars($task['survey_engineer']) ?></small>
                        </td>

                        <td class="civil-info">
                            <?php if ($task['digging_start_date']): ?>
                                <div><i class="fas fa-calendar-check text-success"></i> بدا: <?= $task['digging_start_date'] ?></div>
                                <div><i class="fas fa-calendar-times text-danger"></i> انتهى: <?= $task['digging_end_date'] ?></div>
                                <div class="text-primary small">المسؤول: <?= htmlspecialchars($task['digging_manager']) ?></div>
                            <?php else: ?>
                                <span class="text-warning small"><i class="fas fa-exclamation-triangle"></i> بانتظار بدء الحفر</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="small fw-bold"><?= htmlspecialchars($task['consultant_eng_name'] ?: '---') ?></div>
                        </td>

                        <td>
                            <?php 
                            $badgeClass = ($task['current_stage'] == 'الميدان') ? 'bg-warning text-dark' : 'bg-info text-white';
                            ?>
                            <span class="badge stage-badge <?= $badgeClass ?>"><?= $task['current_stage'] ?></span>
                        </td>

                        <td>
                            <div class="btn-group shadow-sm">
                                <a href="field_works_form.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-primary" title="تعديل البيانات المدنية">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="view_materials.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-secondary" title="عرض المواد">
                                    <i class="fas fa-boxes"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>