<?php include("part/backend-header.php"); ?>
<?php include("part/sql-connection.php"); ?>

<?php 
	
	$query3="SELECT COUNT(*) AS m_number FROM member";
  	$result3=mysqli_query($conn,$query3);

  	$query4="SELECT class_info.c_name, class_info.c_type, COUNT(class_info.c_name) AS f_number FROM favorite, class_info WHERE favorite.c_id=class_info.c_id group by class_info.c_name";
  	$result4=mysqli_query($conn,$query4);

	$query5="SELECT m_id FROM question GROUP BY m_id";
  	$result5=mysqli_query($conn,$query5);

  	$query6="SELECT COUNT(q_id) as q_number FROM question";
  	$result6=mysqli_query($conn,$query6);

  	$query7="SELECT class_info.c_name AS c_name7, class_info.c_type, COUNT(class_info.c_name) AS number7 FROM favorite, class_info WHERE favorite.c_id=class_info.c_id group by class_info.c_name";
  	$result7=mysqli_query($conn,$query7);

  	$query8="SELECT class_info.c_name, class_info.c_type, COUNT(class_info.c_name) AS number8 FROM favorite, class_info WHERE favorite.c_id=class_info.c_id group by class_info.c_name";
  	$result8=mysqli_query($conn,$query8);

  	$query9="SELECT COUNT(q_id) as q_number FROM question";
  	$result9=mysqli_query($conn,$query9);

  	$query10="SELECT class_info.c_type, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_2, COUNT(class_info.c_name) AS number10 FROM favorite, class_info, class_type WHERE favorite.c_id=class_info.c_id AND class_info.c_type=class_type.ct_id group by class_type.ct_name_sec";
  	$result10=mysqli_query($conn,$query10);


    $query11="SELECT class_info.c_type AS c_type, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_2, COUNT(class_info.c_name) AS number11 FROM favorite, class_info, class_type WHERE favorite.c_id=class_info.c_id AND class_info.c_type=class_type.ct_id group by class_type.ct_name_sec ORDER BY class_info.c_type";
    $result11=mysqli_query($conn,$query11);

    $query11_2="SELECT class_info.c_type AS c_type, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_2, COUNT(class_info.c_name) AS number11 FROM favorite, class_info, class_type WHERE favorite.c_id=class_info.c_id AND class_info.c_type=class_type.ct_id group by class_type.ct_name_sec ORDER BY class_info.c_type";
    $result11_2=mysqli_query($conn,$query11_2);

  	$query12="SELECT class_info.c_id AS c_id12, class_info.c_type AS c_type12, class_info.c_name AS c_name12, class_info.t_name AS t_name12 FROM class_type, class_info WHERE class_type.ct_id=class_info.c_type";
  	$result12=mysqli_query($conn,$query12);

    $query13="SELECT class_info.c_id AS c_id13, class_info.c_type AS c_type13, class_info.c_name AS c_name13, class_info.t_name AS t_name13, COUNT(class_info.c_id) AS number13 FROM favorite, class_info WHERE favorite.c_id=class_info.c_id GROUP BY class_info.c_id ORDER BY class_info.c_type";
    $result13=mysqli_query($conn,$query13);

    $query12_2="SELECT class_info.c_id AS c_id12_2, class_info.c_type AS c_type12_2, class_info.c_name AS c_name12_2, class_info.t_name AS t_name12_2 FROM class_type, class_info WHERE class_type.ct_id=class_info.c_type";
    $result12_2=mysqli_query($conn,$query12_2);

    $query13_2="SELECT class_info.c_id AS c_id13_2, class_info.c_type AS c_type13_2, class_info.c_name AS c_name13_2, class_info.t_name AS t_name13_2, COUNT(class_info.c_id) AS number13_2 FROM favorite, class_info WHERE favorite.c_id=class_info.c_id GROUP BY class_info.c_id ORDER BY class_info.c_type";
    $result13_2=mysqli_query($conn,$query13_2);

    /*$query14="SELECT class_info.c_type AS c_type14, class_info.c_name AS c_name14, class_info.t_name AS t_name14, score.s_score AS score14, score.s_type AS s_type14 FROM favorite, class_info, score WHERE favorite.c_id=class_info.c_id AND class_info.c_id=score.c_id";
    $result14=mysqli_query($conn,$query14);*/

    $query14="SELECT class_info.c_id AS c_id14, class_info.c_type AS c_type14, class_info.c_name AS c_name14, class_info.t_name AS t_name14 FROM class_type, class_info WHERE class_type.ct_id=class_info.c_type";
    $result14=mysqli_query($conn,$query14);

    $query15="SELECT class_info.c_name AS c_name15, class_info.t_name AS t_name15, class_info.c_type AS c_type15, question.q_content AS q_content15 FROM question, class_info WHERE question.c_id=class_info.c_id";
    $result15=mysqli_query($conn,$query15);

?>
<html>
  <head>
   <link rel="stylesheet" href="source/css/tabs.css">
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {
        
        var data3 = google.visualization.arrayToDataTable([
          ['身分', '數量'],
          ['有留言的會員', 
            <?php 

              $count4 = 0;
              while($row5 = mysqli_fetch_assoc($result5))
              {
                $count4 += 1;
              }

              echo $count4;

            ?>
          ],
          ['沒留言的會員',
            <?php 

              $row3 = mysqli_fetch_assoc($result3);
              $row3result = $row3["m_number"] - $count4;
              echo $row3result;

            ?>
          ]
        ]);

        var options3 = {
          title: '會員留言數百分比',
          legend: {
            textStyle: {fontSize: 20}
          },
          chartArea: {width: 550},
          fontSize: 30,
          fontName:'Microsoft JhengHei'
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('piechart'));

        chart3.draw(data3, options3);
      }


      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {
        
        var data4 = google.visualization.arrayToDataTable([
          ['種類', '數量'],
          <?php

         $sum7 = 0;
          while($row7 = mysqli_fetch_assoc($result7))
          {
          	$c_name7 = $row7["c_name7"];
          	$c_number7 = $row7["number7"];
          	$sum7 += $c_number7;
          }

          	echo "['有加入我的最愛的課程'".","."$sum7"."],";
          ?>

          ['沒加入我的最愛的課程',
            <?php 

              $sum = 0;
              while($row8 = mysqli_fetch_assoc($result8))
              {
              	  $c_number8 = $row8["number8"];
              	  $sum += $c_number8;
              }
              
              $sum2 = 0;
              $row9 = mysqli_fetch_assoc($result9);
              $q_number = $row9["q_number"];
              $sum2 += $q_number;

              $sum2 = $sum2 - $sum;

              echo $sum2;

            ?>
          ]
        ]);

        var options4 = {
          title: '我的最愛百分比',
          legend: {
            textStyle: {fontSize: 20}
          },
          chartArea: {width: 500},
          fontSize: 30,
          fontName:'Microsoft JhengHei'
        };

        var chart4 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart4.draw(data4, options4);
      }

      
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart5);

      function drawChart5() {
        
        var data5 = google.visualization.arrayToDataTable([
          ['課程向度', '數量'],
          <?php
	          while($row10 = mysqli_fetch_assoc($result10))
	          {
	          	$ct_name = $row10["ct_name"];
	          	$ct_name_2 = $row10["ct_name_2"];
	          	$ct_number10 = $row10["number10"];
	          	
	          	
	          	echo "['$ct_name-$ct_name_2'".","."$ct_number10"."],";
	          }
          ?>
        ]);

        var options5 = {
          title: '我的最愛百分比(課程向度)',
          legend: {
            textStyle: {fontSize: 20}
          },
          chartArea: {width: 1000},
          fontSize: 30,
          fontName:'Microsoft JhengHei'
        };

        var chart5 = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart5.draw(data5, options5);
      }


    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart12);
    function drawChart12() {
      var data12 = google.visualization.arrayToDataTable([
        ["Element", "數量", { role: "style" } ],
        <?php
          $j = 0;
          $j2 = 0;
          $sum12 = 0;
          
          while ($row12 = mysqli_fetch_assoc($result12)) 
          {
            $c_id12[] = $row12["c_id12"];
            $c_type12[] = $row12["c_type12"];
            $c_name12[] = $row12["c_name12"];
            $t_name12[] = $row12["t_name12"];

            $j++;
          }

          while ($row13 = mysqli_fetch_assoc($result13)) 
          {
            $c_id13[] = $row13["c_id13"];
            $c_type13[] = $row13["c_type13"];
            $c_name13[] = $row13["c_name13"];
            $t_name13[] = $row13["t_name13"];
            $number13[] = $row13["number13"];

            $j2++;
          }

          for ($j_1=0; $j_1 < $j; $j_1++) 
          { 
            if ($c_type12[$j_1] === '0') 
            {
              for ($j_2=0; $j_2 < $j2; $j_2++) 
              { 
                if ($c_type12[$j_1] === $c_type13[$j_2]) 
                {
                  if ($c_id12[$j_1] === $c_id13[$j_2]) 
                  {
                    if ($c_name12[$j_1] === $c_name13[$j_2]) 
                    {
                      if ($t_name12[$j_1] === $t_name13[$j_2]) 
                      {
                        $number13[$j_2] += 0;
                      }
                    echo "['".$c_name13[$j_2]."-".$t_name13[$j_2]."',".$number13[$j_2].", '#0044BB'],";
                    }
                  }
                }
              }
            }
          }
          ?>
      ]);

      var view12 = new google.visualization.DataView(data12);
      view12.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options12 = {
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
      var chart12 = new google.visualization.ColumnChart(document.getElementById("columnchart_values12"));
      chart12.draw(view12, options12);
  }
      
	</script>

  </head>
  <body>
    <div id="main">
        <div class="wrapper">
            <?php include("part/sidebar.php"); ?> 

            <div style="margin-top:20px;">
              <center>
              <table style="width:900px;">
                <tr>
                  <td style="width: 33%; border:3px #cccccc solid;" border="1">
                    <center>
                    <font size="4">
                    <a href="#acclove">會員留言數&amp;我的最愛百分比</a>
                    </font>
                    </center>
                  </td>
                  <td style="width: 33%; border:3px #cccccc solid;" border="1">
                    <center> 
                    <font size="4">
                    <a href="#c_per">我的最愛百分比(課程向度)</a>
                    </font>
                    </center>
                  </td>
                  <td style="width: 33%; border:3px #cccccc solid;" border="1">
                    <center> 
                    <font size="4">
                    <a href="#c_name">我的最愛百分比(詳細課名)</a>
                    </font>
                    </center>
                  </td>
                </tr>
              </table>
              </center>
            </div>

        <div style="visibility: hidden">
          <a id="acclove">xxx</a>
        </div>
  			<table>
  				<tr>
  					<td style="width: 50%;">
              <center>
  						<div id="piechart" style="width: 650px; height: 500px; margin-top: 50px;"></div>
              </center>
  					</td>
  					<td style="width: 50%;">
              <center>
  						<div id="piechart2" style="width: 600px; height: 500px; margin-top: 50px;"></div>
              </center>
  					</td>
  				</tr>
  			</table>

        <div style="visibility: hidden">
          <a id="c_per">xxx</a>
        </div>
        <table>
          <tr style="width: 100%;">
            <td>
              <center>
              <div id="piechart3" style="width: 90%; height: 800px; margin-top: 50px;"></div>
              </center>
            </td>
          </tr>
   
        </table>

        <div style="visibility: hidden">
          <a id="c_name">xxx</a>
        </div>
        <center>
        <div class="tabs" style="width: 1255px; height: 500px;  margin-top: 50px;">
        <ul class="tab-list">

        <?php

          $i = 0;
          while ($row11 = mysqli_fetch_assoc($result11)) 
          {
            $c_type3[] = $row11["c_type"];
            $ct_name_23[] = $row11["ct_name_2"];

            if ($c_type3[$i] === '0') 
            {
              echo "<li class='active' style='font-family: Microsoft JhengHei;'>";
              echo "<a class='tab-control' href="."'#tab-".$c_type3[$i]."'><h5>".$ct_name_23[$i]."</h5></a>";
              echo "</li>";
            }
            else
            {
              echo "<li style='font-family: Microsoft JhengHei;'>";
              echo "<a class='tab-control' href="."'#tab-".$c_type3[$i]."'><h5>".$ct_name_23[$i]."</h5></a>";
              echo "</li>";
            }

            $i++;
          }

        ?>
        </ul>

        <?php 

          $i2 = 0;
          $i3_1 = 0;
          while ($row11_2 = mysqli_fetch_assoc($result11_2)) 
          {
            $c_type11_2[] = $row11_2["c_type"];

            $i2++;
            $i3_1++;
          }

          include("tabpic1.php");
          include("tabpic2.php");
          include("tabpic3.php");
          include("tabpic4.php");
          include("tabpic5.php");
          include("tabpic6.php");
          include("tabpic7.php");
          include("tabpic8.php");

          for ($i3=0; $i3 < $i2; $i3++) 
          { 
            if ($c_type11_2[$i3] === '0') 
            {
              echo "<div class='tab-panel active' id='tab-0' style='height: 500px;'>";
              echo "<div id='columnchart_values12'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '1') 
            {
              echo "<div class='tab-panel' id='tab-1' style='height: 500px;'>";
              echo "<div id='columnchart_values13'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '2') 
            {
              echo "<div class='tab-panel' id='tab-2' style='height: 500px;'>";
              echo "<div id='columnchart_values14'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '3') 
            {
              echo "<div class='tab-panel' id='tab-3' style='height: 500px;'>";
              echo "<div id='columnchart_values15'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '4') 
            {
              echo "<div class='tab-panel' id='tab-4' style='height: 500px;'>";
              echo "<div id='columnchart_values16'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '5') 
            {
              echo "<div class='tab-panel' id='tab-5' style='height: 500px;'>";
              echo "<div id='columnchart_values17'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '6') 
            {
              echo "<div class='tab-panel' id='tab-6' style='height: 500px;'>";
              echo "<div id='columnchart_values18'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '7') 
            {
              echo "<div class='tab-panel' id='tab-7' style='height: 500px;'>";
              echo "<div id='columnchart_values19'></div>";
              echo "</div>";
            }
            if ($c_type11_2[$i3] === '8') 
            {
              echo "<div class='tab-panel' id='tab-8' style='height: 500px;'>";
              echo "<div id='columnchart_values20'></div>";
              echo "</div>";
            }
          }

        ?>

        

        
        
        </div>
        </center>
        </div>
      </div>
    <script src="source/js/jquery-3.2.1.min.js"></script>
    <script src="source/js/tabjava.js"></script>
  </body>
</html>
<?php include("part/backend-footer.php"); ?> 