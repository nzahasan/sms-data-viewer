
<div id="rain_graph"></div>
<script>
jQuery.getScript('');
window.onload = function () {
var chart = new CanvasJS.Chart("rain_graph",
{
  title:{
    text: "Rainfall Data"
  },
  animationEnabled: true,
  axisY: {
    title: "Rainfall"
  },
  axisX: {
    labelAngle: -45
  },
  theme: "theme1",
  data: [

  {
    type: "column",

    dataPoints:
    [

        <?php
            include 'include/connect.php';

            $query = "SELECT * FROM `rain_data` WHERE station_id='1'";
            $result = mysqli_query($connection, $query);

            while($row=mysqli_fetch_assoc($result)){

                $date = explode(" ", $row['time']);

                $print = '{y: ';
                $print.= $row['rainfall'];
                $print.= ',  label: "';
                $print.= $date[0];
                $print.= '" },';

                echo $print;
            }
        ?>
      ]}]});
    chart.render();
}
</script>
