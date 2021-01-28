<?php 
$total = array();
$month = array();
if(isset($grafik)){
foreach($grafik as $data){
    $total[] = $data['total'];
    $month[] = $data['month'];
}
}
?>
<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>

<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Universitas Nurtanio Bandung
    </div>
    <strong>Copyright &copy; 2020-2021 <a href="<?php echo base_url('/'); ?>">CRUD with vue js</a>.</strong> All rights reserved.
</footer>
</div>
<script src="<?php echo base_url(); ?>assets/themes/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/themes/dist/js/filter.js"></script>
<?php if(isset($grafik)){?>
<script src="<?php echo base_url(); ?>assets/themes/dist/js/Chart.min.js"></script>
<script>
var chart = document.getElementById("myChart").getContext('2d');
var areaChart = new Chart(chart, {
  type: 'bar',
  data: {
    labels: '<?php echo json_encode($month); ?>',
    datasets: [
      {
        label: "Grafik Penjualan",
        data: <?php echo json_encode($total); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 255, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 255, 255, 1)',
          'rgba(255, 159, 64, 1)',
        ],
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginZero: true
          }
        }
      ]
    }
  }
});
</script>
<?php } ?>
</body>
<script src="<?php echo base_url();?>assets/js/pagination.js"></script>
<script src="<?php echo base_url();?>assets/js/app.js"></script>
</html>
