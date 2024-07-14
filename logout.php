<?php
// تبدأ الجلسة
session_start();

// إزالة كافة البيانات المخزنة في الجلسة
$_SESSION = array();

// إذا كانت الجلسة قيد التشغيل، قم بإنهائها
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// أخيرًا، تدمير الجلسة
session_destroy();

// إعادة توجيه المستخدم إلى صفحة تسجيل الدخول أو أي صفحة أخرى
header("Location: index.php");
exit();
?>