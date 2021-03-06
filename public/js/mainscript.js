function baseUrl()
{
    // var getUrl = window.location;
    // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var baseUrl = location.origin+'/'+pathparts[1]+'/'+pathparts[2].trim('/'); // http://localhost/myproject/
    } else if(location.host.match(/192.168/) != null) {
        var baseUrl = location.origin+'/'+pathparts[1]+'/'+pathparts[2].trim('/'); // http://localhost/myproject/
    } else{
        var baseUrl = location.origin; // http://stackoverflow.com
    }

    return baseUrl;
}

$(function () {

  'use strict'

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May'],
    datasets: [
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'line', 
      data: salesChartData, 
      options: salesChartOptions
    }
  )

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------
});

function AJAX(data, req, redirect)
{
  var notif;
  $.ajax({
    method: 'POST',
    url : req,
    data: data
  })
    .done(function() {
      window.location.replace(redirect);
    })
}

var btnAuto = $('#btnAuto');
var enSesi = $('#enSesi');
var disSesi = $('#disSesi');

// enAuto.on('click', function() {
//   console.log('auto-click');
// })

enSesi.on('click', function() {
  data = {id:enSesi.attr('data')};
  AJAX(data, baseUrl()+'/admin/sesi/aktivasi', baseUrl()+"/admin/")
})

disSesi.on('click', function() {
  data = {id:disSesi.attr('data')};
  AJAX(data, baseUrl()+'/admin/sesi/nonaktif', baseUrl()+"/admin/")
})

btnAuto.on('click', function() {
  data = {id:btnAuto.attr('data')};
  AJAX(data, baseUrl()+'/admin/sesi/setAuto', baseUrl()+"/admin/")
})

// $(document).ready(function(){
//   $("#radioKehadiran1","#radioKehadiran2").change(function() {
//     if($("#radioKehadiran2").is(":checked"))
//     {
//     }
//   })
// })
$("input[name='presensi_kehadiran']").on("change", function(){
  if($("input[name='presensi_kehadiran']:checked").val() == "izin")
  {
    $("#boxKeterangan").append('<div class="mt-3" id="keterangan"><label for="">Keterangan Izin</label><input type="text" class="form-control" name="presensi_keterangan" placeholder="Tuliskan keterangan izin disini..."></div>')
  } else {
    $("#boxKeterangan").find($("#keterangan")).remove()
  }
})

$("input[name='presensi_jeniskelamin']").on("change", function(){
  if($("input[name='presensi_jeniskelamin']:checked").val() == "p")
  {
    $("#saranKegiatan").append('<div class="card"><div class="card-body"><div class="col-md-5"><div class="form-group"><label class="text-md col-form-label-sm">kegiatan keputrian apa yg diharapkan untuk dilaksanakan?</label><textarea name="saranKegiatan" class="form-control"></textarea></div></div></div></div>')
  } else {
    $("#saranKegiatan").find($(".card")).remove()
  }
})