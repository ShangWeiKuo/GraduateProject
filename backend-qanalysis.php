<?php include("part/backend-header.php"); ?>
<?php include("part/sql-connection.php"); ?>

<html>
  <head>
    <script type="text/javascript">
function Get_Yclass(){
  document.MenuForm.action = "QueryCourse.asp";
  document.MenuForm.target = "_self";
  document.MenuForm.submit();     
}

function Submit_Form(){
  var has_error = false;
  var strTemp = "";
  
  if (document.MenuForm.OpenYear.value == "") {
     alert("開課學年不可為空白！");
     has_error = true;
  }   

  if (document.MenuForm.Helf.value == "") {
     alert("開課學期不可為空白！");
     has_error = true;
  }   
      
  if (!has_error) {
     strTemp = '<tr><td width=""33%"">開課學年：'+document.MenuForm.OpenYear.value+
               '　　開課學期：'+document.MenuForm.Helf.options[document.MenuForm.Helf.selectedIndex].text+
               '</td><td width=""33%"">開課部別：'+document.MenuForm.Pclass.options[document.MenuForm.Pclass.selectedIndex].text;
  
     if (document.MenuForm.Sclass.value == "") {
        strTemp = strTemp + "無";
     }   
     else {
        strTemp = strTemp + document.MenuForm.Sclass.options[document.MenuForm.Sclass.selectedIndex].text;
     }   
      
     if (typeof(document.MenuForm.Yclass) == "undefined") { 
        strTemp = strTemp + '</td></tr><tr><td width=""33%"">核心通識類別：'; 
        if (document.MenuForm.CCKind.value == "") {
            strTemp = strTemp + "無";
        }   
        else {
            strTemp = strTemp + document.MenuForm.CCKind.options[document.MenuForm.CCKind.selectedIndex].text;
        }   
     }
       

     strTemp = strTemp + "</td></tr>";
     
     document.MenuForm.Condition.value = strTemp;
     document.MenuForm.target = "_blank";
     document.MenuForm.action = "QueryResult.asp";   
     document.MenuForm.submit(); 
  }   
}


      /*function check()
      {
        if(course.year.value == "") 
        {
          alert("未輸入學年度");
        }
        else if(course.semester.value == "")
        {
          alert("未輸入學期");
        }
        else if(course.type.value == "")
        {
          alert("未輸入通識類別");
        }
        else if(course.cname.value == "")
        {
          alert("未輸入課程名稱");
        }
        else course.submit();
      }*/
    </script>
  </head>
  <body>
    <div id="main">
        <div class="wrapper">
            <?php include("part/sidebar.php"); ?> 
            <form action="" method="post" name="course">
              <table style="width:700px;">
                <tr>
                  <td style="width:35%; padding-left:160px;">
                    學年度:
                  </td>
                  <td style="width:15%;">
                    <select name="year">
                      <option value=" ">請選擇</option>
                      <option value="107">107</option>
                      <option value="107">106</option>
                      <option value="107">105</option>
                    </select>
                  </td>
                  <td style="width:35%; padding-left:160px;">
                    學期:
                  </td>
                  <td style="width:15%;">
                    <select name="semester">
                      <option value=" ">請選擇</option> 
                      <option value="107">一</option>
                      <option value="107">二</option>
                    </select>
                  </td>
                </tr>
              </table>
              <table style="width:1000px;">
                <tr>
                  <td style="width:150px; padding-left:160px;">
                    通識類別:
                  </td>
                  <td style="width:150px;">
                    <select name="type"> 
                      <option value=" ">請選擇</option>
                      <option value="CC">核心通識</option>
                      <option value="LI">通識人文科學</option>
                      <option value="SC">通識自然科學</option>
                      <option value="SO">通識社會科學</option>
                    </select>
                    <input type="hidden">
                  </td>
                  <td style="width:150px; padding-left:160px;">
                    課程名稱:
                  </td>
                  <?php
                    if ($_POST["type"] == "CC") 
                    {
                      echo "1";
                    }
                  ?>
                </tr>
              </table>
            </form>
        </div>
    </div>
    <script src="source/js/jquery-3.2.1.min.js"></script>
    <script src="source/js/accordion.js"></script>
  </body>
</html>
<?php include("part/footer.php"); ?> 