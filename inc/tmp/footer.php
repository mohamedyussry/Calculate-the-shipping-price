
</div>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="https://echo.business">echo.business</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= $plugins; ?>/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $plugins; ?>/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= $plugins; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- Sparkline -->
<script src="<?= $plugins; ?>/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- jQuery Knob Chart -->
<!-- daterangepicker -->
<script src="<?= $plugins; ?>/moment/moment.min.js"></script>
<script src="<?= $plugins; ?>/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= $plugins; ?>/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= $plugins; ?>/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= $plugins; ?>/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $plugins; ?>/datatables/jquery.dataTables.js"></script>
<script src="<?= $plugins; ?>/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= $js; ?>/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
    $(document).ready(function () {
        var table = $('#example1').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "columnDefs": [
                {
                    "searchable": true,
                    "targets": 0 // تحديد العمود الأول
                }
            ],
            "initComplete": function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($('#filters').find('th').eq(column.index()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });
                });
            }
        });
    });
</script>

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
</body>
</html>
