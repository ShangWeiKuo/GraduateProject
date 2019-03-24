<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>單一及多檔案上傳 - 封装成 function</title>
</head>
<body>
    
<form action="doAction.php" method="post" enctype="multipart/form-data">
    <!-- 限制上傳檔案的最大值 -->
    <input type="hidden" name="MAX_FILE_SIZE" value="16777216">

    <!-- accept 限制上傳檔案類型。多檔案上傳 name 的屬性值須定義為 array -->
    <input type="file" name="myFile[]" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block;margin-bottom: 5px;">
    <input type="file" name="myFile[]" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block;margin-bottom: 5px;">
    <input type="file" name="myFile[]" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block;margin-bottom: 5px;">
    <input type="file" name="myFile[]" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block;margin-bottom: 5px;">

    <!-- 使用 html 5 實現單一上傳框可多選檔案方式，須新增 multiple 元素 -->
    <!-- <input type="file" name="myFile[]" id="" accept="image/jpeg,image/jpg,image/gif,image/png" multiple> -->

    <input type="submit" value="上傳檔案">
</form>

</body>
</html>