<?php include_once("part/header.php"); ?>
<?php
/**
 * 表單接收頁面
 */

// 網頁編碼宣告（防止產生亂碼）

if(isset($_SESSION['account'])){
    include_once('part/sql-connection.php');
    $stmt = $conn->prepare('SELECT m_status FROM member WHERE m_account = ?');
    $stmt->bind_param('s', $_SESSION['account']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $r0);
    mysqli_stmt_fetch($stmt);
    $stmt->close();
    if($r0 >= 1){
        header('content-type:text/html;charset=utf-8');
        // 封裝好的單一及多檔案上傳 function
        include_once 'upload.func.php';
        // 重新建構上傳檔案 array 格式
        $files = getFiles();

        // 依上傳檔案數執行
        foreach ($files as $fileInfo) {
            // 呼叫封裝好的 function
            $res = uploadFile($fileInfo);

            // 顯示檔案上傳訊息
            echo $res['mes'] . '<br>';
            // 上傳成功，將實際儲存檔名存入 array（以便存入資料庫）
            if (!empty($res['dest'])) {
                $uploadFiles[] = $res['dest'];
                
            }
            header('Refresh: 3; url=class-info.php?cid='.$_POST['cid']);
        }
    }else if($r0 === 0){
        echo '<script>alert("您的帳號尚未取得發言權限，請完成認證手續。");</script>';    
        header('refresh: 0; url=class-info.php?cid='.$_POST['cid']);
    }else if($r0 === -1){
        echo '<script>alert("您的帳號已被停權，無法發言！");</script>';
        header('refresh: 0; url=class-info.php?cid='.$_POST['cid']);
    }
}else{
    header('refresh: 0; url=index.php');
}


//print_r($uploadFiles);
