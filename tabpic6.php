<?php 

	$query11_2="SELECT class_info.c_type AS c_type, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_2, COUNT(class_info.c_name) AS number11 FROM favorite, class_info, class_type WHERE favorite.c_id=class_info.c_id AND class_info.c_type=class_type.ct_id group by class_type.ct_name_sec ORDER BY class_info.c_type";
    $result11_2=mysqli_query($conn,$query11_2);

	$query12_2="SELECT class_info.c_id AS c_id12_2, class_info.c_type AS c_type12_2, class_info.c_name AS c_name12_2, class_info.t_name AS t_name12_2 FROM class_type, class_info WHERE class_type.ct_id=class_info.c_type";
    $result12_2=mysqli_query($conn,$query12_2);

    $query13_2="SELECT class_info.c_id AS c_id13_2, class_info.c_type AS c_type13_2, class_info.c_name AS c_name13_2, class_info.t_name AS t_name13_2, COUNT(class_info.c_id) AS number13_2 FROM favorite, class_info WHERE favorite.c_id=class_info.c_id GROUP BY class_info.c_id ORDER BY class_info.c_type";
    $result13_2=mysqli_query($conn,$query13_2);

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

          google.charts.load("current", {packages:['corechart']});
          google.charts.setOnLoadCallback(drawChart18);
          function drawChart18() {
            var data18 = google.visualization.arrayToDataTable([
              ["Element", "數量", { role: "style" } ],
              <?php
                $j_2 = 0;
                $j2_2 = 0;
                
                while ($row12_2 = mysqli_fetch_assoc($result12_2)) 
                {
                  $c_id12_2[] = $row12_2["c_id12_2"];
                  $c_type12_2[] = $row12_2["c_type12_2"];
                  $c_name12_2[] = $row12_2["c_name12_2"];
                  $t_name12_2[] = $row12_2["t_name12_2"];

                  $j_2++;
                }

                while ($row13_2 = mysqli_fetch_assoc($result13_2)) 
                {
                  $c_id13_2[] = $row13_2["c_id13_2"];
                  $c_type13_2[] = $row13_2["c_type13_2"];
                  $c_name13_2[] = $row13_2["c_name13_2"];
                  $t_name13_2[] = $row13_2["t_name13_2"];
                  $number13_2[] = $row13_2["number13_2"];

                  $j2_2++;
                }

                for ($j_12=0; $j_12 < $j_2; $j_12++) 
                { 
                  if ($c_type12_2[$j_12] === '6') 
                  {
                    for ($j_22=0; $j_22 < $j2_2; $j_22++) 
                    { 
                      if ($c_type12_2[$j_12] === $c_type13_2[$j_22]) 
                      {
                        if ($c_id12_2[$j_12] === $c_id13_2[$j_22]) 
                        {
                          if ($c_name12_2[$j_12] === $c_name13_2[$j_22]) 
                          {
                            if ($t_name12_2[$j_12] === $t_name13_2[$j_22]) 
                            {
                              $number13_2[$j_22] += 0;
                            }
                          echo "['".$c_name13_2[$j_22]."-".$t_name13_2[$j_22]."',".$number13_2[$j_22].", '#0044BB'],";
                          }
                        }
                      }
                    }
                  }
                }
                ?>
            ]);

            var view18 = new google.visualization.DataView(data18);
            view18.setColumns([0, 1,
                             { calc: "stringify",
                               sourceColumn: 1,
                               type: "string",
                               role: "annotation" },
                             2]);

            var options18 = {
              title: "",
              vAxes: { //值座標
              0: { //第一條線(左側)
                  title: "", //座標軸標題
                  viewWindow: {
                      
                      min: 0 //自訂座標最小值
                  }, 
                  titleTextStyle: {italic: false},
                  showTextEvery: 1 //每隔 5 顯示座標
              }},
              chartArea: {width: 1100},
              width: 1255,
              height: 450,
              bar: {groupWidth: "95%"},
              legend: { position: "none" },
              fontName:'Microsoft JhengHei',
              fontSize: 16
            };
            var chart18 = new google.visualization.ColumnChart(document.getElementById("columnchart_values18"));
            chart18.draw(view18, options18);
        }
        </script>