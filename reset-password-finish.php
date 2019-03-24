<?php include_once("part/header.php"); ?>
<?php include_once('function/pw-hash.php') ?>
<?php include_once('part/sql-connection.php') ?>
<?php
    if(isset($_GET['a']) && isset($_GET['t'])){
        // Check registed status
        $stmt = $conn->prepare('SELECT exdata FROM verification WHERE account = ? AND token = ?');
        $stmt->bind_param('ss', $_GET['a'], $_GET['t']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $exdata);
        $reset_check = false;
        if(mysqli_stmt_fetch($stmt)){
            $reset_check = true;
        }else{
            echo '<script>alert("連線逾時或不正常的操作。")</script>';
            header('Refresh: 0; url=index.php');
        }
        $stmt->close();
        if($reset_check){
            $stmt = $conn->prepare('UPDATE member SET m_password = ? WHERE m_account = ?');
            $stmt->bind_param('ss', $exdata, $_GET['a']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $exdata);
            if(!mysqli_stmt_fetch($stmt)){
                echo '<script>alert("密碼重設完成！請使用新密碼登入。")</script>';
                header('Refresh: 0; url=login.php');
            }
            $stmt->close();
        }
    }else{
        echo '<script>alert("請填入完整資料！")</script>';
        header('Refresh: 0; url=register.php');
    }
?>