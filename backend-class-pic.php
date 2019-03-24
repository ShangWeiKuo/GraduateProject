<?php  

	$query4 = "SELECT class_type.ct_id AS ct_id, class_info.c_name AS c_name, class_info.t_name AS t_name, score.s_score AS s_score, score.s_type AS s_type FROM class_info, class_type, score WHERE class_info.c_id=score.c_id AND class_type.ct_id=class_info.c_type";

  $result4 = mysqli_query($conn,$query4);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "得分", { role: "style" } ],
        <?php 

          $sum2 = 0;
          $relax = 0;
          $interest = 0;
          $use = 0;
          $color_r = '#0044BB';
          $color_i = '#0044BB';
          $color_u = '#0044BB';

        	if (isset($ct_id)) 
          {
            while ($row4 = mysqli_fetch_assoc($result4)) 
            {
              $c_name4[] = $row4["c_name"];
              $t_name4[] = $row4["t_name"];
              $c_type4[] = $row4["ct_id"];
              $s_type4[] = $row4["s_type"];
              $s_score4[] = $row4["s_score"];

              $sum2 += 1;
            }

            for ($i=0; $i < $sum2; $i++) 
            { 
              if ($c_type4[$i] === $ct_id) 
              {
                if ($s_type4[$i] === '0') 
                {
                  $relax += $s_score4[$i];
                }
                if ($s_type4[$i] === '1') 
                {
                  $interest += $s_score4[$i];
                }
                if ($s_type4[$i] === '2') 
                {
                  $use += $s_score4[$i];
                }
              }
            }

            if ($relax < 0) 
            {
              $color_r = '#FF0000';
            }
            if ($interest < 0) 
            {
              $color_i = '#FF0000';
            }
            if ($use < 0) 
            {
              $color_u = '#FF0000';
            }

            echo "['輕鬆性',".$relax.","."'$color_r'"."],";
            echo "['有趣性',".$interest.","."'$color_i'"."],";
            echo "['實用性',".$use.","."'$color_u'"."]";
          }

        ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        chartArea: {left:60, width: 400},
        width: 500,
        height: 250,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        fontName:'Microsoft JhengHei',
        fontSize: 18
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
      </script>
</head>
<body>
	<div id="columnchart_values"></div>
</body>
</html>