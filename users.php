<?php
ob_start();

// تأكد من بدء الجلسة
session_start();

// التحقق من وجود جلسة مسجلة
if (!isset($_SESSION['user_id'])) {
    // إذا لم يكن هناك جلسة مسجلة، يتم تحويل المستخدم إلى الصفحة الرئيسية
    header("Location: index.php");
    exit();
}else{



// استدعاء ملف init.php
include ('inti.php');
// استدعاء header.php
include ($tmp . '/header.php');
if ($_SESSION['user_id'] == 1) {
$do = isset($_GET['do']) ? $_GET['do'] :'manage';
if ($do == 'manage') {  
// استعلام SQL لجلب البيانات من جدول المستخدمين
$stmt = $pdo->query("SELECT * FROM users");
    ?>
    
    
    
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="mb-3">
                        <a href="?do=add" class="btn btn-primary">إضافة مستخدم جديد</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>رقم المستخدم</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>تاريخ التسجيل</th>
                                <th>ادارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['PhoneNumber']) . "</td>";
                                echo "<td>" . calculateTimeElapsed(htmlspecialchars($row['RegistrationDate'])) . "</td>";
                                echo "<td><a href='?do=edit&id=" . $row['UserID'] . "'>تحرير</a> | <a href='?do=delete&id=" . $row['UserID'] . "'>حذف</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

    
    
    
    <?php



    }   elseif ($do == 'add') {
        ?>
         <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title center" >اضافة مستخدم جديد</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form role="form" method="POST" action="?do=insert">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="اسم المستخدم" pattern="[A-Za-z]+" title="الرجاء إدخال أحرف إنجليزية فقط بدون مسافات" required>
                <span id="nameAvailability"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" class="form-control" name="last_name" placeholder="ادخل الاسم بالكامل" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" class="form-control" name="email" placeholder="ادخل البريد الإلكتروني" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="ادخل كلمة المرور" required>
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                        <i id="eyeIcon" class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>رقم الهاتف</label>
                <input type="text" class="form-control" name="phone_number" placeholder="ادخل رقم الهاتف" required>
            </div>
        </div>
      
    </div>
   
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">إرسال</button>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('#first_name').on('input', function() {
        var first_name = $(this).val();
        if (first_name !== '') {
            // قم بإرسال الاستعلام AJAX
            $.ajax({
                type: 'POST',
                url: 'check_first_name.php', // استبدل بملف يحتوي على الكود للتحقق من وجود الاسم
                data: { first_name: first_name },
                success: function(response) {
                    $('#nameAvailability').html(response);
                }
            });
        } else {
            $('#nameAvailability').html('');
        }
    });
});
</script>
<script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                var eyeIcon = document.getElementById("eyeIcon");
                
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }
        </script>


            </div>
            <!-- /.card -->

           

            

            
            

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
        <?php
    } elseif ($do == 'insert') {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // استقبال البيانات المدخلة من النموذج
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone_number = $_POST['phone_number'];
        
            // التحقق مما إذا كان البريد الإلكتروني مستخدمًا بالفعل
            $check_first_name_query = "SELECT * FROM users WHERE FirstName = :first_name";
            $check_first_name_stmt = $pdo->prepare($check_first_name_query);
            $check_first_name_stmt->bindParam(':first_name', $first_name);
            $check_first_name_stmt->execute();
        
            // التحقق من وجود الاسم الأول في قاعدة البيانات
            if ($check_first_name_stmt->rowCount() > 0) {
                echo "الاسم الأول مستخدم بالفعل!";
            } else {
                // تشفير كلمة المرور إلى MD5
                $hashed_password = md5($password);
        
                // التحقق مما إذا كان البريد الإلكتروني مستخدمًا بالفعل
                $check_email_query = "SELECT * FROM users WHERE Email = :email";
                $check_stmt = $pdo->prepare($check_email_query);
                $check_stmt->bindParam(':email', $email);
                $check_stmt->execute();
        
                // التحقق من وجود البريد الإلكتروني في قاعدة البيانات
                if ($check_stmt->rowCount() > 0) {
                    echo "البريد الإلكتروني مستخدم بالفعل!";
                } else {
                    // قم بإدخال البيانات إذا لم يكن البريد الإلكتروني والاسم الأول مستخدمين بالفعل
                    $sql = "INSERT INTO users (FirstName, LastName, Email, Password, PhoneNumber, RegistrationDate, Approved) 
                            VALUES (:first_name, :last_name, :email, :hashed_password, :phone_number, NOW(), 0)";
                    $stmt = $pdo->prepare($sql);
        
                    $stmt->bindParam(':first_name', $first_name);
                    $stmt->bindParam(':last_name', $last_name);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':hashed_password', $hashed_password);
                    $stmt->bindParam(':phone_number', $phone_number);
        
                    if ($stmt->execute()) {
                        echo "تم إضافة المستخدم بنجاح!";
                        // استخدام JavaScript لعرض رسالة لبضع ثوانٍ ومن ثم تحديث الصفحة
                        echo '<script>
                                setTimeout(function(){
                                    window.location.href = "users.php";
                                }, 5000);
                            </script>';
                    } else {
                        echo "حدث خطأ أثناء إضافة المستخدم.";
                    }
                }
            }
        }
        
    } elseif ($do == 'edit') {
        $userID = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE UserID = ?");
        $stmt->execute([$userID]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$user) {
            echo "المستخدم غير موجود!";
            exit();
        }
        ?>
    
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title center">تحرير المستخدم</h3>
                            </div>
                            <form role="form" method="POST" action="?do=update&id=<?php echo $user['UserID']; ?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>الاسم الأول</label>
                                            <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($user['FirstName']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>الاسم الأخير</label>
                                            <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($user['LastName']); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>البريد الإلكتروني</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>كلمة المرور</label>
                                            <div class="input-group">
                                                <input type="password" autocomplete="off" class="form-control" id="password" name="password" placeholder="ادخل كلمة المرور" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                        <i id="eyeIcon" class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>رقم الهاتف</label>
                                            <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($user['PhoneNumber']); ?>" required>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                <!-- يمكنك إضافة المزيد من الحقول حسب احتياجاتك -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                var eyeIcon = document.getElementById("eyeIcon");
                
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }
        </script>
        <?php
    } elseif ($do == 'update') {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    
        // الحصول على البيانات المحدثة من النموذج
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $postal_code = $_POST['postal_code'];
    
        // تشفير كلمة المرور باستخدام MD5
        $hashed_password = md5($password);
    
        // ...
    
        // إعداد استعلام SQL لتحديث البيانات
        $sql = "UPDATE users SET 
                FirstName = :first_name, 
                LastName = :last_name, 
                Email = :email, 
                Password = :password, 
                PhoneNumber = :phone_number, 
                Address = :address, 
                City = :city, 
                State = :state, 
                Country = :country, 
                PostalCode = :postal_code 
                WHERE UserID = :user_id";
    
        // إعداد الاستعلام وربط القيم
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password); // كلمة المرور المشفرة
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':user_id', $userID);
    
        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            echo "تم تحديث البيانات بنجاح!";
            header("Location: users.php");
        } else {
            echo "حدث خطأ أثناء تحديث البيانات.";
        }
    }
    }       elseif ($do == 'delete') {
  // تحقق من وجود ID
  $userID = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

  // استعلام SQL لحذف المستخدم بناءً على الـ ID المحدد
  $stmt = $pdo->prepare("DELETE FROM users WHERE UserID = ?");
  $stmt->execute([$userID]);

  // تأكيد حدوث عملية الحذف
  echo "تم حذف المستخدم بنجاح!";
    }

}else {
    echo "ليس لديك صلاحية الدخول الي هذي الصفحة";
}
}
?>



<?php
// استدعاء footer.php
include ($tmp . '/footer.php');
ob_end_flush();
?>
