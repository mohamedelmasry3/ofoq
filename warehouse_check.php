<?php
require_once 'db_config.php';
// استعلام لحساب العجز بين الكميات
$sql = "SELECT w.*, a.work_order_no, 
        (qty_from_electricity - qty_from_company) as deficit
        FROM warehouse_logs w
        JOIN assignments a ON w.work_order_id = a.id";
$logs = $pdo->query($sql)->fetchAll();
?>
<div class="container mt-5 text-end" dir="rtl">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white"><h4>مطابقة كميات المستودع والعجز</h4></div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>المشروع</th>
                        <th>كود المادة</th>
                        <th>كمية الكهرباء</th>
                        <th>كمية الشركة</th>
                        <th>العجز</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                    <tr class="<?= $log['deficit'] > 0 ? 'table-warning' : '' ?>">
                        <td><?= $log['work_order_no'] ?></td>
                        <td><?= $log['material_code'] ?></td>
                        <td><?= $log['qty_from_electricity'] ?></td>
                        <td><?= $log['qty_from_company'] ?></td>
                        <td class="fw-bold text-danger"><?= $log['deficit'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>