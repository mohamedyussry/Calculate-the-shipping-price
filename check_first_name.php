<?php
// استدعاء ملف init.php
include ('inti.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];

    // تنفيذ التحقق من وجود الاسم الأول في قاعدة البيانات
    $check_first_name_query = "SELECT * FROM users WHERE FirstName = :first_name";
    $check_first_name_stmt = $pdo->prepare($check_first_name_query);
    $check_first_name_stmt->bindParam(':first_name', $first_name);
    $check_first_name_stmt->execute();

    // إرسال رسالة استجابة بناءً على نتيجة التحقق
    if ($check_first_name_stmt->rowCount() > 0) {
        echo '<span style="color: red;">الاسم مستخدم بالفعل</span>';
    } else {
        echo '<span style="color: green;">الاسم متاح.</span>';
    }
}
?>
