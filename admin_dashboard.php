<?php
require_once 'db_config.php';

// دالة لجلب إحصائيات منطقة محددة
function getRegionStats($pdo, $regionName) {
    $stats = [];

    // إجمالي التعميدات للمنطقة
    $stats['total'] = $pdo->prepare("SELECT COUNT(*) FROM assignments a JOIN branches b ON a.branch_id = b.id WHERE b.parent_region = ?");
    $stats['total']->execute([$regionName]);
    $stats['total'] = $stats['total']->fetchColumn();

    // المشاريع الجارية (غير المنتهية) للمنطقة
    $stats['active'] = $pdo->prepare("SELECT COUNT(*) FROM assignments a JOIN branches b ON a.branch_id = b.id WHERE b.parent_region = ? AND a.current_stage != 'منتهٍ'");
    $stats['active']->execute([$regionName]);
    $stats['active'] = $stats['active']->fetchColumn();

    return $stats;
}

// جلب الإحصائيات لكل منطقة
$riyadh_stats = getRegionStats($pdo, 'الرياض');
$abha_stats   = getRegionStats($pdo, 'أبها');
$makkah_stats = getRegionStats($pdo, 'مكة');

// الإجماليات العامة (كما كانت سابقاً)
$total_all = $pdo->query("SELECT COUNT(*) FROM assignments")->fetchColumn();
$license_alerts = $pdo->query("SELECT COUNT(*) FROM digging_licenses WHERE end_date <= CURRENT_DATE + INTERVAL '7 days'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة إحصائيات المناطق - شركة أفق</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="text-center mb-4 text-primary font-weight-bold">متابعة أداء المناطق والفروع</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5><i class="fas fa-map-marker-alt"></i> منطقة الرياض</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>إجمالي التعميدات:</span>
                        <span class="badge bg-primary rounded-pill"><?= $riyadh_stats['total'] ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between text-danger">
                        <span>مشاريع جارية:</span>
                        <span class="fw-bold"><?= $riyadh_stats['active'] ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-header bg-success text-white text-center py-3">
                    <h5><i class="fas fa-mountain"></i> منطقة أبها</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>إجمالي التعميدات:</span>
                        <span class="badge bg-success rounded-pill"><?= $abha_stats['total'] ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between text-danger">
                        <span>مشاريع جارية:</span>
                        <span class="fw-bold"><?= $abha_stats['active'] ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h5><i class="fas fa-kaaba"></i> منطقة مكة</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>إجمالي التعميدات:</span>
                        <span class="badge bg-dark rounded-pill"><?= $makkah_stats['total'] ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between text-danger">
                        <span>مشاريع جارية:</span>
                        <span class="fw-bold"><?= $makkah_stats['active'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-white rounded shadow-sm border-end border-danger border-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="text-danger mb-0"><i class="fas fa-exclamation-triangle"></i> تنبيهات الرخص الحرجة:</h5>
                <p class="text-muted mb-0 small">يوجد لديك <?= $license_alerts ?> رخص ستنتهي خلال 7 أيام أو أقل.</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="digging_licenses.php" class="btn btn-outline-danger btn-sm">مراجعة الرخص</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  