<?php include("part/backend-header.php"); ?>
<?php include("part/sql-connection.php"); ?>

<?php 
	
	$query="SELECT class_info.c_name AS cname, class_type.ct_name AS ct_name, class_type.ct_name_sec AS ct_name_sec, q_content FROM class_info, class_type, question WHERE question.c_id = class_info.c_id AND class_info.c_type = class_type.ct_id";
  $result=mysqli_query($conn,$query);

?>
<html>
  <body>
    <div id="main">
        <div class="wrapper">
          <?php include("part/sidebar.php"); ?>  
          <center>
          <table style="width: 1200px; margin-top: 20px; background-color:white">
            <tr>
              <td colspan="2">
                <center>
                  <h1>
                    <b>
                      核心通識
                    </b>
                  </h1>
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <h4>
                    <a href="https://allpass.info/backend-class.php?ct_id=0">科學素養</a>
                  </h4>
                </center>
              </td>
              <td>
                <center>
                  <h4>
                    <a href="https://allpass.info/backend-class.php?ct_id=1">倫理素養</a>
                  </h4>
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <img src="source/img/science.png" style="width: 500px;">
                </center>
              </td>
              <td>
                <center>
                  <img src="source/img/ethics.png" style="width: 500px;">
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <h4>
                    <a href="https://allpass.info/backend-class.php?ct_id=2">思維方法</a>
                  </h4>
                </center>
              </td>
              <td>
                <center>
                  <h4>
                    <a href="https://allpass.info/backend-class.php?ct_id=3">美學素養</a>
                  </h4>
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <img src="source/img/think.png" style="width: 500px;">
                </center>
              </td>
              <td>
                <center>
                  <img src="source/img/beauty.png" style="width: 500px;">
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <h4>
                    <a href="https://allpass.info/backend-class.php?ct_id=4">公民素養</a>
                  </h4>
                </center>
              </td>
              <td>
                <center>
                  <h4>
                    <a href="https://allpass.info/backend-class.php?ct_id=5">文化素養</a>
                  </h4>
                </center>
              </td>
            </tr>
            <tr>
              <td>
                <center>
                  <img src="source/img/citizen.png" style="width: 500px;">
                </center>
              </td>
              <td>
                <center>
                  <img src="source/img/culture.png" style="width: 500px;">
                </center>
              </td>
            </tr>
          </table>
          </center>

          <center>
            <table style="width: 1200px; margin-top: 150px; background-color:white">
              <tr>
                <td colspan="2">
                  <center>
                    <h1>
                      <b>
                      博雅通識
                      </b>
                    </h1>
                  </center>
                </td>
              </tr>
              <tr>
                <td>
                  <center>
                    <h4>
                      <a href="https://allpass.info/backend-class.php?ct_id=6">人文科學</a>
                    </h4>
                  </center>
                </td>
                <td>
                  <center>
                    <h4>
                      <a href="https://allpass.info/backend-class.php?ct_id=7">自然科學</a>
                    </h4>
                  </center>
                </td>
              </tr>
              <tr>
                <td>
                  <center>
                    <img src="source/img/human_s.png" style="width: 500px;">
                  </center>
                </td>
                <td>
                  <center>
                    <img src="source/img/natural_s.png" style="width: 500px;">
                  </center>
                </td>
              </tr>
              <tr>
                <td>
                  <center>
                    <h4>
                      <a href="https://allpass.info/backend-class.php?ct_id=8">社會科學</a>
                    </h4>
                  </center>
                </td>
              </tr>
              <tr>
                <td>
                  <center>
                    <img src="source/img/society_s.png" style="width: 500px;">
                  </center>
                </td>
              </tr>
            </table>
          </center>
        </div>
    </div>
    <script src="source/js/jquery-3.2.1.min.js"></script>
  </body>
</html>
<?php include("part/backend-footer.php"); ?> 