<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/jquery-3.7.1.min.js" ></script>
<script src="assets/js/custoum.js" ></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<style>
    .see-more-link {
        cursor: pointer;
        color: blue;
        text-decoration: underline;
        
    }
</style>
<script>
    $(document).ready(function () {
        $(".see-more-link").on("click", function () {
            var cell = $(this).closest(".description-cell");
            var shortDesc = cell.find(".short-desc");
            var fullDesc = cell.find(".full-desc");

            if (shortDesc.is(":visible")) {
                shortDesc.hide();
                fullDesc.show();
                $(this).text("See Less");
            } else {
                shortDesc.show();
                fullDesc.hide();
                $(this).text("See More");
            }
        });

        $(".see-more-link").on("click", function (e) {
            e.preventDefault();r

            var cell = $(this).closest(".description-cell");
            var fullDesc = cell.find(".full-desc");
            if (fullDesc.text().trim() === "") {
                
                $.ajax({
                    url: 'path/to/your/full-description-endpoint',
                    type: 'GET',
                    success: function (data) {
                    },
                    error: function (error) {
                        console.error('Error fetching full description:', error);
                    }
                });
            }
        });
    });
</script>

<style>
    .search-match {
        background-color: #ffffcc; /* Add your preferred background color */
    }
</style>
<style>
    .highlight {
        background-color: yellow; /* Change to your preferred highlight color */
       
    }
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
      <script>
          <?php 
          if (isset($_SESSION['message']))
          { 
            ?>
                alertify.set('notifier','position', 'top-right');
                alertify.success('<?= $_SESSION['message']; ?> ');
            <?php
            unset($_SESSION['message']);
          }
          ?>
      </script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
 

</script>