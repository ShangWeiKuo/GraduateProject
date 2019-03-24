<?php include("part/sql-connection.php"); ?>

<?php 

	$query3="SELECT question.m_id, member.m_account, q_content, q_time, class_info.c_name AS c_name, class_info.c_code, class_info.t_name, class_info.c_time from question, member, class_info WHERE question.m_id=member.m_id AND question.c_id=class_info.c_id ORDER BY q_time";
	                
	$result3=mysqli_query($conn,$query3);

	while ($row3 = mysqli_fetch_assoc($result3)) 
    {
                      
        $m_account3 = $row3["m_account"];
        $c_name = $row3["c_name"];

        if ($m_account3 == "z82js94")
        {
        	echo "$c_name";
            echo "<br>";
        }
      
    }

?>