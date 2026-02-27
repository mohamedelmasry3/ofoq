<?php
require_once 'db_config.php';
// جلب الرخص المسجلة مع بيانات أمر العمل
$sql = "SELECT dl.*, a.work_order_no 
        FROM digging_licenses dl
        JOIN field_works fw ON dl.field_work_id = fw.id
        JOIN assignments a ON fw.work_order_id = a.id";
$licenses = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة رخص الحفر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white"><h4>تتبع رخص الحفر والتصاريح</h4></div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>رقم أمر العمل</th>
                        <th>رقم الرخصة</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($licenses as $l): 
                        $is_expired = strtotime($l['end_date']) < time();
                    ?>
                    <tr>
                        <td><?= $l['work_order_no'] ?></td>
                        <td><?= $l['license_no'] ?></td>
                        <td><?= $l['end_date'] ?></td>
                        <td>
                            <?php if($is_expired): ?>
                                <span class="badge bg-danger">منتهية</span>
                            <?php else: ?>
                                <span class="badge bg-success">سارية</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>