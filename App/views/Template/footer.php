        </div><!-- /.pt-3 -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline-block">
    <strong>Copyright &copy; 2020 <a href="#">PPG Jakarta Pusat</a>.</strong>
    All rights reserved.
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> -->
<!-- jQuery -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/dist/js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?=BASEURL?>vendor/almasaeed2010/adminlte/plugins/toastr/toastr.min.js"></script>
<script src="<?=BASEURL?>js/mainscript.js"></script>
<script>
  function pieChart(api)
  {
      $.get(api, function(data) {
        var requestData = $.parseJSON(data);
        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */
        // Get context with jQuery - using jQuery's .get() method.
        var donutData        = {
          labels: [
              'TPQ AL-HAFIDHUN',
              'TPQ AL-MUHSININ',
              'TPQ AL-ICHSAN',
              'TPQ H. M. NURUDDIN',
              'TPQ AL-FIRDAUS',
              'TPQ ANNAFIU',
              'TPQ BAITUL ISTIQOMAH',
              'TPQ ASSYUHADA',
          ],
          datasets: [
            {
              // data: [1,0,2,0,1,0,0,3],
              data: requestData,
              backgroundColor : ['#6a8caf','#4baea0','#f67280','#99d8d0','#be9fe1','#eb8242','#9cf196','#484c7f'],
            }
          ]
        }
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = donutData;
        var pieOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
          type: 'pie',
          data: pieData,
          options: pieOptions
        })
      });
  }

  function ajax(data, req)
  {
    data = $(this).serialize();
    $.ajax({
      url : req,
      type: 'POST',
      data: data
    });
  }
  function btnAjax(id, req, type=null)
  {
    // var res = typeof req;
    var url = req;
    if(type == null)
    {
      $.post(req, {id:id} );
      $('#card-active'+id).addClass('d-none');
      $('#modal_delete').modal('hide');
    }else{
      switch (type) {
        case 'delete':

          $('#modal_delete').modal();
          $('#modal_delete').on('hidden.bs.modal',function(){
            $('#del_btn').remove();
          })
          $('#modal_delete_btn').append('<button type="button" id="del_btn" class="btn btn-danger float-left" onclick="deleteButton('+id+',&#039;'+url+'&#039;)">Hapus</button>');
          break;
      }
    }
  }

const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

  function deleteButton(id,req)
  {

    var data = {id:id};
    $.ajax({
      type: "POST",
      url: req,
      data: data,
      success: function() {
        $('#modal_delete').modal('hide');
        $('#card-active'+id).addClass('d-none');
        toastr.error('Data berhasil dihapus');
      }
    });
    // var jqxhr =  $.post(req, {id:id})
  }
</script>
</body>
</html>