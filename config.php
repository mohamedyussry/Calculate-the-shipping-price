<?php
// معلومات الاتصال بقاعدة البيانات
$host = 'localhost';
$dbname = 'calculator';
$username = 'root';
$password = '';
$charset = 'utf8mb4'; // تعيين ترميز اللغة

try {
    // اتصال بقاعدة البيانات باستخدام PDO مع تعيين ترميز اللغة
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);

    // تعيين الخيارات لـ PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // يمكنك الآن استخدام متغير $pdo لتنفيذ استعلامات قاعدة البيانات
    // مثلاً:
    // $pdo->query("SELECT * FROM table_name");
} catch (PDOException $e) {
    // في حالة فشل الاتصال بقاعدة البيانات
    echo "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
}
?>
