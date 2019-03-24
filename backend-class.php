<?php include("part/backend-header.php"); ?>
<?php include("part/sql-connection.php"); ?>

<?php 

if (isset($_GET["ct_id"])) 
{
	$ct_id = $_GET["ct_id"];

	$query = "SELECT class_info.c_name AS c_name, class_info.c_type AS c_type FROM question, class_info, class_type WHERE question.c_id=class_info.c_id AND class_info.c_type=class_type.ct_id GROUP BY c_name";
	$result = mysqli_query($conn,$query);

	$query2 = "SELECT class_info.c_name AS c_name, class_info.t_name AS t_name, class_info.c_type AS c_type, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_sec, question.q_content AS q_content FROM question, class_info, class_type WHERE question.c_id=class_info.c_id AND class_info.c_type=class_type.ct_id";
	$result2 = mysqli_query($conn,$query2);

	$query3 = "SELECT c_type, t_name, c_name FROM class_info, question WHERE class_info.c_id=question.c_id GROUP BY t_name, c_name";
	$result3 = mysqli_query($conn,$query3);

	$query5 = "SELECT class_type.ct_id AS ct_id, class_info.c_name AS c_name, class_info.t_name AS t_name, score.s_score AS s_score, score.s_type AS s_type FROM class_info, class_type, score WHERE class_info.c_id=score.c_id AND class_type.ct_id=class_info.c_type";
  	$result5 = mysqli_query($conn,$query5);

?>
<html>
	<head>
		<link rel=stylesheet type='text/css' href='./source/css/accordion.css'>
	</head>
	<body>
		<div id='main'>
	  		<div class='wrapper'>


<?php include("part/sidebar.php"); ?>
<?php

			echo "<table>";
				echo "<tr>";
					echo "<td colspan='2'>";
					if ($ct_id === '0') 
					{
						echo "<center>";
                  		echo "<h3><b>科學素養</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '1') 
					{
						echo "<center>";
                  		echo "<h3><b>倫理素養</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '2')
					{
						echo "<center>";
                  		echo "<h3><b>思維方法</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '3')
					{
						echo "<center>";
                  		echo "<h3><b>美學素養</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '4')
					{
						echo "<center>";
                  		echo "<h3><b>公民素養</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '5')
					{
						echo "<center>";
                  		echo "<h3><b>文化素養</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '6')
					{
						echo "<center>";
                  		echo "<h4><b>人文科學</b></h4>";
                		echo "</center>";
					}
					else if ($ct_id === '7')
					{
						echo "<center>";
                  		echo "<h3><b>自然科學</b></h3>";
                		echo "</center>";
					}
					else if ($ct_id === '8')
					{
						echo "<center>";
                  		echo "<h3><b>社會科學</b></h3>";
                		echo "</center>";
					}
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td style='width:50%'>";
					if ($ct_id === '0') 
					{
						echo "<center>";
                  		echo "<img src='source/img/science.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '1') 
					{
						echo "<center>";
                  		echo "<img src='source/img/ethics.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '2')
					{
						echo "<center>";
                  		echo "<img src='source/img/think.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '3')
					{
						echo "<center>";
                  		echo "<img src='source/img/beauty.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '4')
					{
						echo "<center>";
                  		echo "<img src='source/img/citizen.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '5')
					{
						echo "<center>";
                  		echo "<img src='source/img/culture.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '6')
					{
						echo "<center>";
                  		echo "<img src='source/img/human_s.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '7')
					{
						echo "<center>";
                  		echo "<img src='source/img/natural_s.png' style='width: 500px;'>";
                		echo "</center>";
					}
					else if ($ct_id === '8')
					{
						echo "<center>";
                  		echo "<img src='source/img/society_s.png' style='width: 500px;'>";
                		echo "</center>";
					}
					echo "</td>";

					echo "<td style='width:50%'>";
						echo "<center>";
						include("backend-class-pic.php");
						echo "</center>";
					echo "</td>";
				echo "</tr>";
			echo "</table>";
			echo "<center>";
			echo "<ul class='accordion' style='margin-top: 50px; width: 1200px;'>";
                echo "<li>";
?>
<?php

				$i = 0;
				$j = 0;
				$sum = 0;
				$sum5 = 0;
		        
		        $color_r5 = '#0044BB';
          		$color_i5 = '#0044BB';
          		$color_u5 = '#0044BB';

				while ($row = mysqli_fetch_assoc($result)) 
				{
					$c_type[] = $row["c_type"];
					$c_name[] = $row["c_name"];

					if ($c_type[$i] === $ct_id) 
					{
						echo "<button class='accordion-control' style='background-color:#00FFFF'>"."<font size='5px;'><b>".$c_name[$i]."</b></font>"."</button>";

						echo "<div class='accordion-panel'>";

						echo "<table>";
						  	echo "<tr>";
						  		echo "<td style='width:20%;'>";
						  		echo "<center><h5><b>授課教師</b></h5></center>";
						  		echo "</td>";
						  		echo "<td style='width:20%;'>";
						  		echo "<center><h5><b>感想分數</b></h5>(輕鬆/有趣/實用)</center>";
						  		echo "</td>";
						  		echo "<td style='width:60%;'>";
						  		echo "<center><h5><b>評論內容</b></h5></center>";
						  		echo "</td>";
						  	echo "</tr>";
						  	
						while ($row2 = mysqli_fetch_assoc($result2)) 
						{
							$c_type2[] = $row2["c_type"];
						  	$c_name2[] = $row2["c_name"];
						  	$t_name2[] = $row2["t_name"];
						  	$ct_name2[] = $row2["ct_name"];
						  	$ct_name_sec2[] = $row2["ct_name_sec"];
						  	$q_content2[] = $row2["q_content"];
						  	
						  	if (isset($q_content2[$j])) 
							{
							  	$sum += 1;
							}
							$j += 1;
					  	}

					  	while ($row3 = mysqli_fetch_assoc($result3)) 
						{
							$c_type3[] = $row3["c_type"];
						  	$c_name3[] = $row3["c_name"];
						  	$t_name3[] = $row3["t_name"];
					  	}

					  	while ($row5 = mysqli_fetch_assoc($result5)) 
			            {
				            $c_name5[] = $row5["c_name"];
				            $t_name5[] = $row5["t_name"];
				            $c_type5[] = $row5["ct_id"];
				            $s_type5[] = $row5["s_type"];
				            $s_score5[] = $row5["s_score"];

              				$sum5 += 1;
			            }
					  	
					  	for ($k=0; $k<$sum; $k++)
					  	{
					  		if ($c_type3[$k] === $c_type[$i]) 
							{
							  	if ($c_name3[$k] === $c_name[$i]) 
								{
									echo "<tr>";
										echo "<td style='width:20%;'>";
										echo "<center><font size='5px;'>";
								  		echo $t_name3[$k];
								  		echo "</font></center>";
								  		echo "</td>";

								  		echo "<td style='width:20%;'>";
								  		$relax5 = 0;
								        $interest5 = 0;
								        $use5 = 0;
										for ($n=0; $n < $sum5; $n++) 
								  		{ 
								  			if ($c_type5[$n] === $c_type3[$k]) 
								  			{
								  				if ($t_name5[$n] === $t_name3[$k]) 
								  				{
								  					if ($s_type5[$n] === '0') 
								  					{
								  						$relax5 += $s_score5[$n];
								  					}
								  					if ($s_type5[$n] === '1') 
								  					{
								  						$interest5 += $s_score5[$n];
								  					}
								  					if ($s_type5[$n] === '2') 
								  					{
								  						$use5 += $s_score5[$n];
								  					}
								  				}
								  			}
								  		}
								  		echo "<center><b>";
								  		if ($relax5 < 0) 
								  		{
								  			$color_r5 = '#FF0000';
								  		}
								  		if ($relax5 >= 0) 
								  		{
								  			$color_r5 = '#0044BB';
								  		}
								  		if ($interest5 < 0) 
								  		{
								  			$color_i5 = '#FF0000';
								  		}
								  		if ($interest5 >= 0) 
								  		{
								  			$color_i5 = '#0044BB';
								  		}
								  		if ($use5 < 0) 
								  		{
								  			$color_u5 = '#FF0000';
								  		}
								  		if ($use5 >= 0) 
								  		{
								  			$color_u5 = '#0044BB';
								  		}
								  		echo "<font size='5px;' color='".$color_r5."'>";
									  		echo $relax5;
								  		echo "</font>";
								  		echo "&nbsp;";
									  	echo "/";
									  	echo "&nbsp;";
								  		echo "<font size='5px;' color='".$color_i5."'>";
									  		echo $interest5;
								  		echo "</font>";
								  		echo "&nbsp;";
									  	echo "/";
									  	echo "&nbsp;";
								  		echo "<font size='5px;' color='".$color_u5."'>";
									  		echo $use5;
								  		echo "</font>";
								  		echo "</b></center>";
								  		echo "</td>";

								  		echo "<td style='width:60%;'>";
								  		echo "<ul>";
								  		$z = 0;
								  		for ($m=0; $m < $sum; $m++) 
								  		{ 
								  			if ($c_type2[$m] === $c_type3[$k]) 
								  			{
								  				if ($t_name2[$m] === $t_name3[$k]) 
								  				{
								  					$z += 1;
								  					
								  					echo "<li>";
								  					echo "<b>";
								  					echo $z;
								  					echo ".";
								  					echo "</b>";
								  					echo "&nbsp;";
								  					echo "&nbsp;";
								  					echo "&nbsp;";
								  					echo "&nbsp;";
								  					echo "<font size='4px;'>";
													echo $q_content2[$m];
													echo "</font>";
													echo "</li>";
													echo "<br>";
													
								  				}
								  			}
								  			/*if ($c_name2[$m] === $c_name[$i]) 
											{
												if ($t_name2[$m] === $t_name[$i]) 
												{
													echo "<li>";
													echo $q_content2[$m];
													echo "</li>";
												}
											}*/
								  		}
								  		echo "</ul>";
								  		
										echo "</td>";
							  		echo "<tr>";
						  		}
							}
					  	}
					  	
					  	/*for ($k1=0; $k1<$sum; $k1++)
					  	{
					  		if ($c_type2[$k1] === $c_type3[$x]) 
							{
							  	if ($c_name2[$k1] === $c_name3[$x]) 
								{
									
						  		}
							}
					  	}*/
					  	
					  	echo "</table>";

					  	echo "</div>";
					}
					
					$i++;
					
				}

?>		
<?php
					echo "</li>";
				echo "</ul>";
				echo "</center>";
?>
			</div>
		</div>

	<script src='source/js/jquery-3.2.1.min.js'></script>
    <script src='source/js/accordion.js'></script>

    </body>
</html>
<?php } ?>
<?php include("part/backend-footer.php"); ?> 