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
$do = isset($_GET['do']) ? $_GET['do'] :'manage';
if ($do == 'manage') {  
// استعلام SQL لجلب البيانات من جدول المستأجرين
$stmt = $pdo->query("SELECT * FROM calculatordetails");
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
                        <a href="?do=add" class="btn btn-primary">اله حاسبة</a>
                    </div>
                    <div class="table-responsive" id="filters">
                    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>رقم الصفقه</th>
            <th>العرض النهائي</th>
            <th>ضريبة المعاملات</th>
            <th>رسوم كوبارت</th>
            <th>رسوم  للمعاملات</th>
            <th>رسوم الوثائق</th>
            <th>المضاعف</th>
            <th>الإجمالي</th>
            <th>سعر الشحن</th>
            <th>الجمارك</th>
            <th>الإجمالي النهائي</th>
            <th>الضريبة</th>
            <th>إدارة</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['DealNumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FinalBid']) . "</td>";
            echo "<td>" . htmlspecialchars($row['TransactionTax']) . "</td>";
            echo "<td>" . htmlspecialchars($row['CopartFees']) . "</td>";
            echo "<td>" . htmlspecialchars($row['AutoBidMasterTransactionFees']) . "</td>";
            echo "<td>" . htmlspecialchars($row['DocumentationFees']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Multiplier']) . "</td>";
            echo "<td>" . htmlspecialchars($row['TotalPlus10']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ShippingPrice']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Customs']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FinalTotal']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Tax']) . "</td>";
            echo "<td><a href='?do=edit&id=" . $row['CalculatorID'] . "'>تحرير</a> | <a href='?do=delete&id=" . $row['CalculatorID'] . "'>حذف</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

                </div>
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
                <button onclick="openPDF('w8-sacars-sll.pdf')">ملف PDF w8-sacars-sll</button>
                <button onclick="openPDF('w8-sacars-sohar.pdf')">ملف PDF w8-sacars-sohar</button>

                <script>
                    function openPDF(pdfURL) {
                        // افتح PDF في نافذة جديدة
                        var newWindow = window.open(pdfURL, '_blank', 'toolbar=no,scrollbars=yes,resizable=yes,width=600,height=800');

                        // يتم فتح نافذة جديدة في محاولة حظر الإعلانات. يجب أن يكون مُسمّى النافذة عنصرًا فريدًا.
                        if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {
                            alert('يبدو أن مانع الإعلانات قد يمنع فتح النافذة.');
                        }
                    }
                </script>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
              
        <form role="form" method="POST" action="?do=insert">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="FinalBid">العرض النهائي</label>
                        <input type="text" class="form-control" id="FinalBid" name="FinalBid" placeholder="ادخل العرض النهائي" oninput="calculateValues()" required>
                    </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label for="TransactionTax">ضريبة المعاملات</label>
                    <input type="text" class="form-control" id="TransactionTax" name="TransactionTax" placeholder="ادخل ضريبة المعاملات" oninput="calculateValues()" required>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label for="CopartFees">رسوم كوبارت</label>
                    <input type="text" class="form-control" id="CopartFees" name="CopartFees" placeholder="ادخل رسوم كوبارت" oninput="calculateValues()" required>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label for="AutoBidMasterTransactionFees">رسوم  للمعاملات</label>
                    <input type="text" class="form-control" id="AutoBidMasterTransactionFees" name="AutoBidMasterTransactionFees" placeholder="ادخل رسوم AutoBidMaster للمعاملات" oninput="calculateValues()" required>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label for="DocumentationFees">رسوم الوثائق</label>
                    <input type="text" class="form-control" id="DocumentationFees" name="DocumentationFees" placeholder="ادخل رسوم الوثائق" oninput="calculateValues()" required>
                </div>
                </div>
                <div class="col-md-1" style="display: none;">
                    <div class="form-group">
                        <label for="Multiplier">المضاعف</label>
                        <input type="text" class="form-control" id="Multiplier" name="Multiplier" placeholder="المضاعف" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="TotalPlus10">الإجمالي</label>
                        <input type="text" class="form-control" id="TotalPlus10" name="TotalPlus10" placeholder="الإجمالي + 10" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="DealNumber">رقم الصفقة</label>
                        <input type="text" class="form-control" id="DealNumber" name="DealNumber" placeholder="ادخل رقم الصفقة" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ShippingPrice">سعر الشحن</label>
                        <input type="text" class="form-control" id="ShippingPrice" name="ShippingPrice" placeholder="ادخل سعر الشحن" oninput="calculateValues()" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Customs">الجمارك</label>
                        <input type="text" class="form-control" id="Customs" name="Customs" placeholder="ادخل الجمارك" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="FinalTotal">الإجمالي النهائي</label>
                        <input type="text" class="form-control" id="FinalTotal" name="FinalTotal" placeholder="ادخل الإجمالي النهائي" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Tax">الضريبة</label>
                        <input type="text" class="form-control" id="Tax" name="Tax" placeholder="ادخل الضريبة" readonly>
                    </div>
                </div>
            </div>

    <!-- أي حقول إضافية أخرى إذا كانت موجودة -->
    <button type="submit" class="btn btn-primary">إرسال</button>
</form>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            // تمنع الإرسال الافتراضي للنموذج
            event.preventDefault();

            // قائمة بأسماء الحقول التي تحتاج للتحقق منها
            var fieldsToCheck = ['#FinalBid', '#TransactionTax', '#CopartFees', '#AutoBidMasterTransactionFees', '#DocumentationFees', '#ShippingPrice'];

            // القيام بالتحقق من الحقول
            var isValid = true;
            fieldsToCheck.forEach(function(field) {
                var value = $(field).val();
                if (!$.isNumeric(value)) {
                    alert('يجب أن تكون القيم في الحقول الرقمية فقط');
                    isValid = false;
                    return false; // يتوقف عن التحقق فور العثور على قيمة غير رقمية
                }
            });

            // إذا كانت جميع القيم رقمية، قم بإرسال النموذج
            if (isValid) {
                this.submit();
            }
        });
    });
</script> 
<script>
    function calculateValues() {
        var finalBid = parseFloat(document.getElementById('FinalBid').value) || 0;
        var transactionTax = parseFloat(document.getElementById('TransactionTax').value) || 0;
        var copartFees = parseFloat(document.getElementById('CopartFees').value) || 0;
        var autoBidMasterTransactionFees = parseFloat(document.getElementById('AutoBidMasterTransactionFees').value) || 0;
        var documentationFees = parseFloat(document.getElementById('DocumentationFees').value) || 0;
        var shippingPrice = parseFloat(document.getElementById('ShippingPrice').value) || 0;

        var total = finalBid + transactionTax + copartFees + autoBidMasterTransactionFees + documentationFees;
        var multiplier = total * 0.386;
        var totalPlus10 = multiplier + 10;

        var customs = (totalPlus10 + shippingPrice) * 0.05;
        var finalTotal = totalPlus10 + shippingPrice + customs;

        var additionalCharge = (finalTotal + shippingPrice) * 0.05; // حساب القيمة الإضافية

        var finalTotalWithAdditionalCharge = finalTotal + additionalCharge; // القيمة النهائية مع القيمة الإضافية

        document.getElementById('Multiplier').value = multiplier.toFixed(2);
        document.getElementById('TotalPlus10').value = totalPlus10.toFixed(2);
        document.getElementById('Customs').value = customs.toFixed(2);
        document.getElementById('FinalTotal').value = finalTotal.toFixed(2);
        document.getElementById('Tax').value = additionalCharge.toFixed(2); // إضافة القيمة الإضافية إلى حقل الضريبة
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
            $dealNumber = $_POST['DealNumber'] ?? '';
            $finalBid = $_POST['FinalBid'] ?? '';
            $transactionTax = $_POST['TransactionTax'] ?? '';
            $copartFees = $_POST['CopartFees'] ?? '';
            $autoBidMasterTransactionFees = $_POST['AutoBidMasterTransactionFees'] ?? '';
            $documentationFees = $_POST['DocumentationFees'] ?? '';
            $shippingPrice = $_POST['ShippingPrice'] ?? '';
            $customs = $_POST['Customs'] ?? '';
            $finalTotal = $_POST['FinalTotal'] ?? '';
            $tax = $_POST['Tax'] ?? '';
            $multiplier = $_POST['Multiplier'] ?? '';
            $totalPlus10 = $_POST['TotalPlus10'] ?? '';
        
            // إعداد وتنفيذ الاستعلام لإدراج البيانات
            $sql = "INSERT INTO calculatordetails (DealNumber, FinalBid, TransactionTax, CopartFees, AutoBidMasterTransactionFees, DocumentationFees, ShippingPrice, Customs, FinalTotal, Tax, Multiplier, TotalPlus10)
                    VALUES (:dealNumber, :finalBid, :transactionTax, :copartFees, :autoBidMasterTransactionFees, :documentationFees, :shippingPrice, :customs, :finalTotal, :tax, :multiplier, :totalPlus10)";
            
            $stmt = $pdo->prepare($sql);
        
            // ربط القيم بالمتغيرات
            $stmt->bindParam(':dealNumber', $dealNumber);
            $stmt->bindParam(':finalBid', $finalBid);
            $stmt->bindParam(':transactionTax', $transactionTax);
            $stmt->bindParam(':copartFees', $copartFees);
            $stmt->bindParam(':autoBidMasterTransactionFees', $autoBidMasterTransactionFees);
            $stmt->bindParam(':documentationFees', $documentationFees);
            $stmt->bindParam(':shippingPrice', $shippingPrice);
            $stmt->bindParam(':customs', $customs);
            $stmt->bindParam(':finalTotal', $finalTotal);
            $stmt->bindParam(':tax', $tax);
            $stmt->bindParam(':multiplier', $multiplier);
            $stmt->bindParam(':totalPlus10', $totalPlus10);
        
            // تنفيذ الاستعلام
            $stmt->execute();
        
            // تحويل المستخدم إلى صفحة calc.php
            header('Location: calc.php');
            exit; // تأكد من الخروج بعد إرسال رأس الطلب
        }
        
        

    


    } elseif ($do == 'edit') {

        
    } elseif ($do == 'update') {

    } elseif ($do == 'delete') {
        if (isset($_GET['do']) && $_GET['do'] === 'delete' && isset($_GET['id'])) {
            $calculatorID = $_GET['id'];
        
            try {
                // استعلام SQL لحذف سجل معين من جدول calculatordetails
                $stmt = $pdo->prepare("DELETE FROM calculatordetails WHERE CalculatorID = ?");
                $stmt->execute([$calculatorID]);
        
                // تأكد من حدوث عملية الحذف
                if ($stmt->rowCount() > 0) {
                    echo "تم حذف السجل بنجاح!";
                } else {
                    echo "لم يتم العثور على سجل لحذفه.";
                }
            } catch (PDOException $e) {
                // يمكنك التعامل مع الأخطاء هنا
                echo "حدث خطأ: " . $e->getMessage();
            }
        }
    
    }
}
?>



<?php
// استدعاء footer.php
include ($tmp . '/footer.php');
ob_end_flush();
?>
