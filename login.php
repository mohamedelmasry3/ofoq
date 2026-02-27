<?php
/**
 * نظام أفق البنية التحتية - صفحة تسجيل الدخول
 */
session_start();

// منع المستخدم المسجل دخوله مسبقاً من العودة لصفحة الدخول
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | نظام أفق</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 15px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .card-header {
            background: white;
            border-bottom: none;
            text-align: center;
            padding: 30px 20px 10px;
            border-radius: 20px 20px 0 0 !important;
        }

        .logo-icon {
            font-size: 3rem;
            color: #1e3c72;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            margin-bottom: 5px;
        }

        .btn-login {
            background: #1e3c72;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #2a5298;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: white;
        }

        .alert {
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 10px 0 0 10px !important; /* تعديل للـ RTL */
        }
        
        /* ضبط الحواف للغة العربية */
        .rtl-input {
            border-radius: 0 10px 10px 0 !important;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card p-3">
        <div class="card-header">
            <div class="logo-icon">
                <i class="fas fa-hard-hat"></i>
            </div>
            <h4 class="fw-bold text-dark">شركة أفق</h4>
            <p class="text-muted small">نظام الإدارة المتكامل للبنية التحتية</p>
        </div>

        <div class="card-body">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <div>
                        خطأ في اسم المستخدم أو كلمة المرور
                    </div>
                </div>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">اسم المستخدم</label>
                    <div class="input-group">
                        <input type="text" name="username" class="form-control rtl-input" placeholder="أدخل اسم المستخدم" required>
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">كلمة المرور</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control rtl-input" placeholder="••••••••" required>
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-login mb-3">
                    دخول للنظام <i class="fas fa-sign-in-alt ms-2"></i>
                </button>
            </form>
        </div>
        
        <div class="card-footer bg-white border-0 text-center pb-4">
            <small class="text-muted">© 2026 جميع الحقوق محفوظة - شركة أفق</small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>