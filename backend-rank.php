<?php include("part/backend-header.php"); ?>
<?php include("part/sql-connection.php"); ?>

<?php
  /*$connect=mysqli_connect("localhost","root","295@025*2","allpass");
  mysqli_query($connect,'SET NAMES utf8');*/
  $query="SELECT question.m_id, member.m_account, COUNT(question.q_id) AS number from question, member WHERE question.m_id=member.m_id GROUP BY question.m_id";
  $result=mysqli_query($conn,$query);
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
            ["帳戶", "留言次數", { role: "style" } ],
            <?php
               
                $color="#b87333";
                while($row = mysqli_fetch_assoc($result))
                {
                  if ($row["number"]<=20) 
                  {
                    $color="#b87333";
                  }
                  else if ($row["number"]>20 && $row["number"]<=100) 
                  {
                    $color="#888888";
                  }
                  else
                  {
                    $color="#FF0000";
                  }
                  
                  echo "['".$row["m_account"]."',".$row["number"].","."'$color'"."],";  
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
            title: "會員帳戶的留言次數",
            titleTextStyle:{
              fontSize: 30
            },
            chartArea: {width: 1200},
            height: 600,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
            fontName:'Microsoft JhengHei'
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>

  
  </head>
  <body>
    <div id="main">
        <div class="wrapper">
            <?php include("part/sidebar.php"); ?> 
            
            <div style="margin-top:20px;">
              <center>
              <table style="width:500px;">
                <tr>
                  <td style="width: 25%; border:3px #cccccc solid;" border="1">
                    <center>
                    <font size="4">
                    <a href="#barchart">會員帳戶的留言次數</a>
                    </font>
                    </center>
                  </td>
                  <td style="width: 25%; border:3px #cccccc solid;" border="1">
                    <center> 
                    <font size="4">
                    <a href="#detail">留言內容</a>
                    </font>
                    </center>
                  </td>
                </tr>
              </table>
              </center>
            </div>

            <div style="visibility: hidden">
              <a id="barchart">xxx</a>
            </div>
            <center>
            <div id="columnchart_values" style="margin-top: 50px; width: 1500px; height: 300px;"></div>
            </center>
            <div style="margin-top: 300px; visibility: hidden">
            <a id="detail">xxx</a>
            </div>
            <center>
            <h3 style="font-family: Microsoft JhengHei;">
              <hr style="margin-top: 50px; width:39%; display:inline-block;" size="3" color="gray">
                  留言內容
              <hr style="margin-top: 50px; width:39%; display:inline-block;" size="3" color="gray">
            </h3>
              
              <ul class="accordion" style="margin-top: 50px; width: 1200px;">
                <li>
                <?php 

                  $query2="SELECT question.m_id, member.m_account, COUNT(question.q_id) AS number from question, member WHERE question.m_id=member.m_id GROUP BY question.m_id";
                
                  $result2=mysqli_query($conn,$query2);

                  $query3="SELECT question.m_id, member.m_account, q_content, q_time, class_info.c_name, class_info.c_code, class_info.t_name, class_info.c_time from question, member, class_info WHERE question.m_id=member.m_id AND question.c_id=class_info.c_id ORDER BY q_time";
                
                  $result3=mysqli_query($conn,$query3);

                  $query4="SELECT COUNT(question.q_content) AS number2 from question";

                  $result4=mysqli_query($conn,$query4);

                 /* $query5="SELECT question.m_id, member.m_account AS m_account, q_content, q_time, class_info.c_name AS c_name, class_info.t_name AS t_name from question, member, class_info WHERE question.m_id=member.m_id AND question.c_id=class_info.c_id ORDER BY q_time";
                
                  $result5=mysqli_query($conn,$query5);*/

                  $i = 0;
                  $j = 0;
                  $color="#b87333";
                  
                  $sum = 0;
                  while ($row2 = mysqli_fetch_assoc($result2)) 
                  {
                    $m_account2[] = $row2["m_account"];
                    $num = $row2["number"];
                    
                    if ($row2["number"]<=20) 
                    {
                      $color="#b87333";
                    }
                    else if ($row2["number"]>20 && $row2["number"]<=100) 
                    {
                      $color="#888888";
                    }
                    else
                    {
                      $color="#FF0000";
                    }
                   echo "<button class='accordion-control' style='background-color:".$color."'><font size='5px;'><b>".$m_account2[$i]." (".$num.")"."</b></font></button>";

                    while ($row3 = mysqli_fetch_assoc($result3)) 
                    {
                      
                      $m_account3[] = $row3["m_account"];
                      $q_time[] = $row3["q_time"];
                      $q_content[] = $row3["q_content"];
                      $c_name[] = $row3["c_name"];
                      $c_code[] = $row3["c_code"];
                      $c_time[] = $row3["c_time"];
                      $t_name[] = $row3["t_name"];
      
                    }
                    //$sum = $sum + $num;
                    
                    $row4 = mysqli_fetch_assoc($result4);
                    $number2 = $row4["number2"];
                    $sum += $number2;

                    echo "<div class='accordion-panel'>";

                    echo "<table>";
                      echo "<tr>";
                        echo "<td style='width: 33%;'>";
                          echo "<center><h5><b>授課教師</b></h5></center>";
                        echo "</td>";
                        echo "<td style='width: 33%;'>";
                          echo "<center><h5><b>課程名稱</b></h5></center>";
                        echo "</td>";
                        echo "<td style='width: 33%;'>";
                          echo "<center><h5><b>評論內容</b></h5></center>";
                        echo "</td>";
                      echo "</tr>";

                      echo "<tr>";
                      for ($y=0; $y < $sum; $y++) 
                      {
                        if ($m_account2[$i] == 'lollinlol777') 
                        {
                            echo "<td>";
                              echo "<center>";
                              echo "<img src='source/img/Figure_1.jpg'  style='width: 300px;'>";
                              echo "</center>";
                            echo "</td>";
                            echo "<td>";
                              echo "<center>";
                              echo "<img src='source/img/Figure_2.png' style='width: 300px;'>";
                              echo "</center>";
                              echo "</td>";
                            echo "<td>";
                              echo "<center>";
                              echo "<img src='source/img/Figure_3.png' style='width: 300px;'>";
                              echo "</center>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'a1043354') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/a1043354_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/a1043354_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/a1043354_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'johnny860726') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/johnny_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/johnny_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/johnny_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'a1043304') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/a1043304_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/a1043304_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/a1043304_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'admin') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/admin_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/admin_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/admin_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'dcard') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/dcard_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/dcard_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/dcard_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == '12345') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/12345_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/12345_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/12345_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'anton61207') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/anton_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/anton_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/anton_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                        if ($m_account2[$i] == 'z82js94') 
                        {
                            echo "<td>";
                              echo "<img src='source/img/z82js94_tname.png'  style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/z82js94_cname.png' style='width: 300px; margin-left:10px;'>";
                              echo "</td>";
                            echo "<td>";
                              echo "<img src='source/img/z82js94_question.png' style='width: 300px; margin-left:10px;'>";
                            echo "</td>";
                            break;
                        }
                      }
                      echo "</tr>";
                    echo "</table>";

                    echo "<table>";
                    echo "<tr>";
                    echo "<td style='width: 15%;'>";
                    echo "<h5><b>填寫時間</b></h5>";
                    echo "</td>";
                    echo "<td style='width: 15%;'>";
                    echo "<h5><b>課程名稱</b></h5>";
                    echo "</td>";
                    echo "<td style='width: 15%;'>";
                    echo "<h5><b>授課教師</b></h5>";
                    echo "</td>";
                    echo "<td>";
                    echo "<center><h5><b>評論內容</b></h5></center>";
                    echo "</td>";
                    echo "</tr>";
                    for ($k=0; $k < $sum; $k++) 
                    {
                      if ($m_account2[$i] == $m_account3[$k]) 
                      {
                        echo "<tr>";
                        echo "<td style='width: 15%;'>";
                        echo "<font size='4px;'>";
                        echo $q_time[$k];
                        echo "</font>";
                        echo "</td>";
                        echo "<td style='width: 15%;'>";
                        echo "<font size='4px;'>";
                        echo $c_name[$k];
                        echo "</font>";
                        echo "</td>";
                        echo "<td style='width: 15%;'>";
                        echo "<font size='4px;'>";
                        echo $t_name[$k];
                        echo "</font>";
                        echo "</td>";
                        echo "<td>";
                        echo "<font size='4px;'>";
                        echo $q_content[$k];
                        echo "</font>";
                        echo "</td>";
                        echo "</tr>";
                      }
                    }
                    echo "</table>";
                    echo "</div>";

                    $i++;
                  }
                ?>  
                </li>
              </ul>
              </center>
        </div>
    </div>
    <script src="source/js/jquery-3.2.1.min.js"></script>
    <script src="source/js/accordion.js"></script>
  </body>
</html>
<?php include("part/backend-footer.php"); ?> 