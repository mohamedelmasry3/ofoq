<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نظام أفق لإدارة المشاريع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .step-card { transition: transform 0.3s; cursor: pointer; text-decoration: none !important; }
        .step-card:hover { transform: translateY(-10px); }
        .step-number { position: absolute; top: -15px; right: -15px; width: 40px; height: 40px;
                       background: #333; color: #fff; border-radius: 50%; display: flex;
                       align-items: center; justify-content: center; font-weight: bold; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-5 shadow">
    <div class="container">
        <span class="navbar-brand mb-0 h1"><i class="fas fa-city me-2"></i> شركة أفق البنية التحتية - نظام الإدارة المتكامل</span>
        <a href="admin_dashboard.php" class="btn btn-outline-info btn-sm">لوحة الإحصائيات العامة <i class="fas fa-chart-line"></i></a>
    </div>
</nav>

<div class="container">
    <div class="row g-4">
        <a href="add_assignment.php" class="col-md-4 step-card">
            <div class="card h-100 border-0 shadow-sm border-top border-primary border-5">
                <div class="step-number">1</div>
                <div class="card-body text-center">
                    <i class="fas fa-file-import fa-3x text-primary mb-3"></i>
                    <h5 class="card-title text-dark">إسناد أوامر العمل</h5>
                    <p class="text-muted small">إدخال المشاريع الجديدة وتوزيعها على الفروع</p>
                </div>
            </div>
        </a>

        <a href="field_works.php" class="col-md-4 step-card">
            <div class="card h-100 border-0 shadow-sm border-top border-info border-5">
                <div class="step-number">2</div>
                <div class="card-body text-center">
                    <i class="fas fa-hard-hat fa-3x text-info mb-3"></i>
                    <h5 class="card-title text-dark">الأعمال الميدانية</h5>
                    <p class="text-muted small">تسجيل الحفر وحجز المواد من المستودع</p>
                </div>
            </div>
        </a>

        <a href="digging_licenses.php" class="col-md-4 step-card">
            <div class="card h-100 border-0 shadow-sm border-top border-danger border-5">
                <div class="step-number">3</div>
                <div class="card-body text-center">
                    <i class="fas fa-id-card fa-3x text-danger mb-3"></i>
                    <h5 class="card-title text-dark">رخص الحفر</h5>
                    <p class="text-muted small">إدارة وتجديد تصاريح العمل والبلدية</p>
                </div>
            </div>
        </a>

        <a href="electrical_works.php" class="col-md-4 step-card">
            <div class="card h-100 border-0 shadow-sm border-top border-warning border-5">
                <div class="step-number">4</div>
                <div class="card-body text-center">
                    <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                    <h5 class="card-title text-dark">أعمال الكهرباء</h5>
                    <p class="text-muted small">توثيق التمديدات الفنية ورفع الصور</p>
                </div>
            </div>
        </a>

        <a href="warehouse_check.php" class="col-md-4 step-card">
            <div class="card h-100 border-0 shadow-sm border-top border-secondary border-5">
                <div class="step-number">5</div>
                <div class="card-body text-center">
                    <i class="fas fa-boxes-stacked fa-3x text-secondary mb-3"></i>
                    <h5 class="card-title text-dark">المستودع والمطابقة</h5>
                    <p class="text-muted small">حساب عجز المواد ومطابقة الكميات</p>
                </div>
            </div>
        </a>

        <a href="asphalt_extracts.php" class="col-md-4 step-card">
            <div class="card h-100 border-0 shadow-sm border-top border-success border-5">
                <div class="step-number">6</div>
                <div class="card-body text-center">
                    <i class="fas fa-check-double fa-3x text-success mb-3"></i>
                    <h5 class="card-title text-dark">الأسفلت والمستخلصات</h5>
                    <p class="text-muted small">إغلاق الموقع نهائياً وإصدار المطالبة المالية</p>
                </div>
            </div>
        </a>
    </div>

    <footer class="text-center mt-5 text-muted small">
        &copy; 2026 شركة أفق البنية التحتية | جميع الحقوق محفوظة
    </footer>
</div>

</body>
</html>