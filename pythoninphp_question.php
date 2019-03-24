<?php include("part/sql-connection.php"); ?>

<?php 

	/*$query3="SELECT question.m_id, member.m_account, q_content, q_time, class_info.c_name AS c_name, class_info.c_code, class_info.t_name AS t_name, class_info.c_time from question, member, class_info WHERE question.m_id=member.m_id AND question.c_id=class_info.c_id ORDER BY q_time";
	                
	$result3=mysqli_query($conn,$query3);

	while ($row3 = mysqli_fetch_assoc($result3)) 
    {
                      
        $m_account3 = $row3["m_account"];
        $c_name3 = $row3["c_name"];
        $t_name3 = $row3["t_name"];
        $q_content = $row3["q_content"];

        if ($m_account3 == "z82js94")
        {
            if ($c_name3 == "企業倫理") 
            {
                if ($t_name3 == "陳致仁") 
                {
                    echo "$q_content";
                    echo "<br>";
                }
            } 
        }
      
    }*/

    $query="SELECT class_info.c_name AS cname, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_sec, q_content FROM class_info, class_type, question WHERE question.c_id = class_info.c_id AND class_info.c_type = class_type.ct_id";
    $result=mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($result)) 
            {
              $cname = $row["cname"];
              $ct_name = $row["ct_name"];
              $ct_name_sec = $row["ct_name_sec"];
              $q_content = $row["q_content"];

              /*if ($ct_name === '核心通識') 
              {*/
                /*if ($ct_name_sec === '科學素養') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '倫理素養') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '思維方法') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '美學素養') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '公民素養') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '文化素養') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
              //}
              /*if ($ct_name === '博雅通識') 
              {*/
                /*if ($ct_name_sec === '人文科學') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '自然科學') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '社會科學') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
              //}
              if ($ct_name === '共同必修')
              {
                /*if ($ct_name_sec === '中文') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                /*if ($ct_name_sec === '英文') 
                {
                  echo $q_content;
                  echo "<br>";
                }*/
                if ($ct_name_sec === '進階英文') 
                {
                  echo $q_content;
                  echo "<br>";
                }
              }
            }

?>