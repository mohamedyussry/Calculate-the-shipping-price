<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- شعار العلامة التجارية -->
    <a href="index3.html" class="brand-link">
        <img src="<?= $img; ?>/AdminLTELogo.png" alt="لوجو AdminLTE" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">إدارة (Echo ERP)  </span>
    </a>

    <!-- الشريط الجانبي -->
    <div class="sidebar">
        <!-- الوحدة الاختيارية: لوحة المستخدم في الشريط الجانبي -->
        

        <!-- قائمة الشريط الجانبي -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- إضافة الأيقونات إلى الروابط باستخدام فئة .nav-icon -->
                
                <li class="nav-item">
                    <a href="calc.php" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            الالة الحاسبة
                            <span class="right badge badge-danger">جديد</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            ادارة المستخدمين
                            <span class="right badge badge-danger">جديد</span>
                        </p>
                    </a>
                </li>
                <!-- وحدة الخيارات التصميمية -->
                
                <!-- ... وهكذا -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
