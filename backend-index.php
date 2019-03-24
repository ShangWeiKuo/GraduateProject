<?php include("part/backend-header.php"); ?>
<?php include("part/sql-connection.php"); ?>
<?php 
  $query="SELECT DATE(q_time), COUNT(q_id) as number FROM question GROUP BY DATE(q_time)";
  $result=mysqli_query($conn,$query);

  $query2="SELECT DATE(question.q_time) AS date, class_type.ct_id, class_type.ct_name, class_type.ct_name_sec, COUNT(class_type.ct_id) AS number from class_info, question, class_type where class_info.c_id=question.c_id AND class_info.c_type=class_type.ct_id GROUP BY DATE(question.q_time)";
  /*SELECT MONTH(question.q_time) AS date, class_type.ct_id, class_type.ct_name, class_type.ct_name_sec, COUNT(class_type.ct_id) AS number from class_info, question, class_type where class_info.c_id=question.c_id AND class_info.c_type=class_type.ct_id GROUP BY class_type.ct_name_sec*/
  $result2=mysqli_query($conn,$query2);

  $query3="SELECT COUNT(*) AS m_number FROM member";
  $result3=mysqli_query($conn,$query3);

  $query6="SELECT MONTH(q_time), COUNT(q_id) as number FROM question GROUP BY MONTH(q_time)";
  $result6=mysqli_query($conn,$query6);
  /*$query3="SELECT class_type.ct_name, class_type.ct_name_sec, COUNT(class_type.ct_id) AS number from class_info, question, class_type where class_info.c_id=question.c_id AND class_info.c_type=class_type.ct_id GROUP BY class_type.ct_name_sec";
  $result3=mysqli_query($conn,$query3);*/
?>
<html>
<head>
 <link rel=stylesheet type="text/css" href="./source/css/accordion.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['日期', '留言數'],
        <?php
          while($row = mysqli_fetch_assoc($result))
          {

            $date11 = substr($row["DATE(q_time)"] , 5 , 5);

            echo "['".$date11."',".$row["number"]."],"; 
          }
        ?>
      ]);

      var options = {
          title: '網站每日留言數',
          titleTextStyle:{
            fontSize: 30
          },
          chartArea: {width: 980},
          pointSize:10,
          hAxis: {title: '日期', titleTextStyle: {color: '#333', fontSize: 20, italic: false}},
          vAxis: {minValue: 0},
          fontSize: 16,
          fontName:'Microsoft JhengHei'
        };

      var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

      google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart6);
        function drawChart6() {
          var data6 = google.visualization.arrayToDataTable([
            ["月份", "留言次數", { role: "style" } ],
            <?php
               
                $color="#0066FF";
                $sum12 = 0;

                while($row6 = mysqli_fetch_assoc($result6))
                {
                  $date6 = $row6["MONTH(q_time)"];
                  $number6 = $row6["number"];
                  
                  for ($q=1; $q<=12; $q++)
                  {
                    if ($date6 == $q) 
                    {
                      $sum12 = $number6 + $sum12;
                    }
                  }

                  echo "['".$date6."',".$sum12.","."'$color'"."],";  
                }
            ?>
          ]);

          var view6 = new google.visualization.DataView(data6);
          view6.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);

          var options6 = {
            title: "每月的留言總數",
            titleTextStyle:{
              fontSize: 30
            },
            hAxis: {title: '月份', titleTextStyle: {color: '#333', fontSize: 20, italic: false}},
            chartArea: {width: 980},
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
            fontName:'Microsoft JhengHei'
          };
          var chart6 = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
          chart6.draw(view6, options6);
      }


      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
            var data2 = google.visualization.arrayToDataTable([
        ['月份', '核心通識-科學素養', '核心通識-倫理素養', '核心通識-思維方法', '核心通識-美學素養',
         '核心通識-公民素養', '核心通識-文化素養', '博雅通識-社會科學', '博雅通識-自然科學', '博雅通識-人文科學', '共同必修-中文', '共同必修-英文', '共同必修-進階英文', { role: 'annotation' } ],
        <?php
          $number = array(
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                          array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
                        );
         
          while($row2 = mysqli_fetch_assoc($result2))
          {
            $date = $row2["date"];
            $number2 = $row2["number"];
            $ct_name_sec = $row2["ct_name_sec"];
           
            for ($i=0; $i<12; $i++)
            {
              $sub = substr( $date , 5 , 2); //new
              $sub += 0; //new
              if ($sub == ($i+1)) 
              {
                $number[$i][0] = substr( $date , 0 , 7);

                if ($ct_name_sec == "科學素養") 
                {
                  $number[$i][1] = $number[$i][1] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][1] = $number[$i][1];
                  }
                }
                else if ($ct_name_sec == "倫理素養") 
                {
                  $number[$i][2] = $number[$i][2] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][2] = $number[$i][2];
                  }
                }
                else if ($ct_name_sec == "思維方法") 
                {
                  $number[$i][3] = $number[$i][3] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][3] = $number[$i][3];
                  }
                }
                else if ($ct_name_sec == "美學素養") 
                {
                  $number[$i][4] = $number[$i][4] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][4] = $number[$i][4];
                  }
                }
                else if ($ct_name_sec == "公民素養") 
                {
                  $number[$i][5] = $number[$i][5] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][5] = $number[$i][5];
                  }
                }
                else if ($ct_name_sec == "文化素養") 
                {
                  $number[$i][6] = $number[$i][6] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][5] = $number[$i][5];
                  }
                }
                else if ($ct_name_sec == "社會科學") 
                {
                  $number[$i][7] = $number[$i][7] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][7] = $number[$i][7];
                  }
                }
                else if ($ct_name_sec == "自然科學") 
                {
                  $number[$i][8] = $number[$i][8] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][8] = $number[$i][8];
                  }
                }
                else if ($ct_name_sec == "人文科學") 
                {
                  $number[$i][9] = $number[$i][9] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][9] = $number[$i][9];
                  }
                }
                else if ($ct_name_sec == "中文") 
                {
                  $number[$i][10] = $number[$i][10] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][10] = $number[$i][10];
                  }
                }
                else if ($ct_name_sec == "英文") 
                {
                  $number[$i][11] = $number[$i][11] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][11] = $number[$i][11];
                  }
                }
                else if ($ct_name_sec == "進階英文") 
                {
                  $number[$i][12] = $number[$i][12] + $number2;
                  for($x=$i; $x<12; $x++)
                  {
                    $number[$x][12] = $number[$i][12];
                  }
                }
              }
            }
          }

          for ($j=0; $j < 12; $j++) 
          { 
            if ($number[$j][0]) 
            {
              echo "['".$number[$j][0]."',".$number[$j][1].",".$number[$j][2].",".$number[$j][3].",".$number[$j][4].",".$number[$j][5].",".$number[$j][6].",".$number[$j][7].",".$number[$j][8].",".$number[$j][9].",".$number[$j][10].",".$number[$j][11].",".$number[$j][12].","."' '"."],";
            }
          }
          
        ?>
      ]);

      var options_fullStacked = {
        title: '課程向度每月留言量百分比',
          titleTextStyle:{
            fontSize: 30
          },
          isStacked: 'percent',
          legend: {position: 'right', maxLines: 3, textStyle: {fontSize: 16}},
          chartArea: {width: 550,height: 600},
          hAxis: {
            minValue: 0,
            ticks: [0, .3, .6, .9, 1],
            title: '百分比',
            titleTextStyle: {italic: false}
          },
          vAxis: {
            minValue: 0,
            ticks: [0, .3, .6, .9, 1],
            title: '時間',
            titleTextStyle: {italic: false}
          },
          fontSize: 20,
          fontName:'Microsoft JhengHei'
        };

        var chart = new google.visualization.BarChart(document.getElementById("container"));
        chart.draw(data2, options_fullStacked);
      }
  </script>
</head>
<body>
    <div id="main">
        <div class="wrapper">
          <?php include("part/sidebar.php"); ?>
            <div style="margin-top:20px;">
              <center>
              <table style="width:1200px;">
                <tr>
                  <td style="width: 25%; border:3px #cccccc solid;" border="1">
                    <center>
                    <font size="4">
                    <a href="#daily">網站每日留言數</a>
                    </font>
                    </center>
                  </td>
                  <td style="width: 25%; border:3px #cccccc solid;" border="1">
                    <center> 
                    <font size="4">
                    <a href="#month">每月的留言總數</a>
                    </font>
                    </center>
                  </td>
                  <td style="width: 25%; border:3px #cccccc solid;" border="1">
                    <center> 
                    <font size="4">
                    <a href="#c_chart">課程向度每月留言量(百分比)</a>
                    </font>
                    </center>
                  </td>
                  <td style="width: 25%; border:3px #cccccc solid;" border="1">
                    <center> 
                    <font size="4">
                    <a href="#c_table">課程向度每月留言量(列表)</a>
                    </font>
                    </center>
                  </td>
                </tr>
              </table>
              </center>
            </div>
            
            <div style="visibility: hidden">
                    <a id="daily">xxx</a>
            </div>
              <center>
              <div id="chart_div" style="width: 95%; height: 550px; margin-top: 50px;"></div>
              </center>
            <div style="visibility: hidden">
                    <a id="month">xxx</a>
            </div>
            <center>
            <div id="columnchart_values2" style="width: 95%; height: 500px; margin-top: 50px;"></div> 
            </center>
            <center>
            <table style="width: 100%;">
              <tr>
                <td style="width: 70%;">
                  <div style="margin-top: 30px; visibility: hidden">
                    <a id="c_chart">xxx</a>
                  </div>
                    <div id="container" style="width: 100%; height: 910px; padding-top: 30px; padding-left: 30px; padding-bottom: 30px; padding-right: 20px;"></div>
                  </td>
                <td style="width: 30%;">
                  <div style="margin-top: 30px; visibility: hidden">
                    <a id="c_table">xxx</a>
                  </div>
                   <center>
                    <div style="background-color: #FFFFFF; width: 450px; height: 850px; padding-top: 35px; margin-right: 20px; padding-right: 20px;">
                   
                  <ul>
                  <?php
                    $sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = $sum7 = $sum8 = $sum9 = $sum10 = $sum11 = $sum12 = 0;
                  
                    echo "<li style='font-size: 25px;'>";
                      
                      echo "<div style='padding-left:30px;'>";
                      echo "<b>";
                      echo "課程向度";
                      for ($a=0; $a < 15; $a++) 
                      { 
                        echo "&nbsp;";
                      }
                      echo "關注次數";
                      echo "</b>";
                      echo "</div>";
                    echo "</li>";
                    echo "<br>";

                    echo "<div style='font-size: 20px;'>";
                    echo "<li>";
                      echo "核心通識-科學素養";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum1 = $number[$a][1];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum1;
                    echo "</li>";
                    echo "<br>";
                    
                    echo "<li>";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "核心通識-倫理素養";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum2 = $number[$a][2];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum2;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "核心通識-思維方法";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum3 = $number[$a][3];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum3;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "核心通識-美學素養";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum4 = $number[$a][4];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum4;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "核心通識-公民素養";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum5 = $number[$a][5];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum5;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "核心通識-文化素養";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum6 = $number[$a][6];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum6;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "博雅通識-社會科學";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum7 = $number[$a][7];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum7;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "博雅通識-自然科學";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum8 = $number[$a][8];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum8;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "博雅通識-人文科學";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum9 = $number[$a][9];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum9;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "共同必修-中文";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                       
                        if ($number[$a][0] != 0) 
                        {
                          $sum10 = $number[$a][10];
                        }
                      }
                      echo "&nbsp;";
                      echo " ";
                      echo $sum10;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "共同必修-英文";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo "&nbsp;";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                       
                        if ($number[$a][0] != 0) 
                        {
                          $sum11 = $number[$a][11];
                        }
                      }
                      echo "&nbsp;";
                      echo " ";
                      echo $sum11;
                    echo "</li>";
                    echo "<br>";

                    echo "<li>";
                      echo "共同必修-進階英文";
                      for ($a=0; $a < 12; $a++) 
                      { 
                        echo "&nbsp;";
                        if ($number[$a][0] != 0) 
                        {
                          $sum12 = $number[$a][12];
                        }
                      }
                      echo "&nbsp;";
                      echo "&nbsp;";
                      echo $sum12;
                    echo "</li>";
                    echo "<br>";
                    echo "</div>";
                  ?>  
                  </ul>
                  
                  </div>
                  </center>
                  </td>

              </tr>
            </table>
            </center>
        
    </div>


<script src="source/js/jquery-3.2.1.min.js"></script>
</body>
</html>
<?php include("part/backend-footer.php"); ?> 