<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow mb-4">
    <div class="container">
        <a class="navbar-brand" href="admin_dashboard.php">نظام أفق</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        القائمة الرئيسية
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="admin_dashboard.php">لوحة التحكم</a></li>
                        <li><a class="dropdown-item" href="add_assignment.php">إسناد طلب</a></li>
                        <li><a class="dropdown-item" href="projects_status.php">متابعة الحالات</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php">تسجيل الخروج</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>