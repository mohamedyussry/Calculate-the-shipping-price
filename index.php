<?php

// تحقق تسجيل الدخول وحفظ الجلسة
session_start();
include("inti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = $_POST['first_name'];
  $password = $_POST['password'];

  // تشفير كلمة المرور باستخدام md5
  $encrypted_password = md5($password);

  $stmt = $pdo->prepare("SELECT * FROM users WHERE FirstName = :first_name AND Password = :password");
  $stmt->execute(['first_name' => $first_name, 'password' => $encrypted_password]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
      $_SESSION['user_id'] = $user['UserID'];

      // تحقق من الـ ID قبل توجيه المستخدم
      if ($user['UserID'] == 1) {
          // يمكنك توجيه المستخدم إلى صفحة معينة بعد تسجيل الدخول بنجاح
          header("Location: calc.php?do=add");
          exit();
      } else {
          echo "ليس لديك الصلاحية للدخول!";
      }
  } else {
      echo "بيانات تسجيل الدخول غير صحيحة!";
  }
}


if (isset($_SESSION['user_id'])) {
    header("Location: calc.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $plugins; ?>/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= $plugins; ?>/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $css; ?>/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="logo.png" width="200" alt="" style="border-radius: 10px;">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">تسجيل الدخول لبدء الجلسة الخاصة بك</p>

      <form action="index.php" method="post">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="اسم المستخدم" dir="rtl" name="first_name" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
      </div>

    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="كلمة المرور" dir="rtl" name="password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
        </div>
    </div>
</form>


       <div class="social-auth-links text-center mb-3">
        <!-- <p>- أو -</p> -->
        <!-- <a href="register.php" class="btn btn-block btn-primary">
           تسجيل عضوية جديده <i class="fas fa-users"></i>
        </a> -->
        <!--<a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> تسجيل الدخول باستخدام جوجل بلس
        </a>-->
      </div> 
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="#">نسيت كلمة المرور الخاصة بي</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">تسجيل عضوية جديدة</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= $plugins; ?>/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= $plugins; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
