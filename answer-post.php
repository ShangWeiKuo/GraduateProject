<?php include_once("part/header.php"); ?>
<?php include_once('part/sql-connection.php') ?>
<?php
    if(isset($_POST['qid']) && isset($_POST['cid']) && isset($_POST['content']) && isset($_SESSION['account'])){
        $stmt = $conn->prepare('SELECT m_status FROM member WHERE m_account = ?');
        $stmt->bind_param('s', $_SESSION['account']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r0);
        mysqli_stmt_fetch($stmt);
        $stmt->close();
        if($r0 >= 1){
            if(trim($_POST['content']) !== ''){
                $stmt = $conn->prepare('INSERT INTO answer (m_id, q_id, c_id, a_content) VALUES (?, ?, ?, ?)');
                $stmt->bind_param('ddds', $_SESSION['m_id'], $_POST['qid'], $_POST['cid'], $_POST['content']);
                mysqli_stmt_execute($stmt);
            }else{
                echo '<script>alert("請確實填寫內容！");</script>';
            }
            header('refresh: 0; url=class-info.php?cid='.$_POST['cid'].'#test-swipe-2');
        }else if($r0 === 0){
            echo '<script>alert("您的帳號尚未取得發言權限，請完成認證手續。");</script>';    
            header('refresh: 0; url=class-info.php?cid='.$_POST['cid'].'#test-swipe-2');
        }else if($r0 === -1){
            echo '<script>alert("您的帳號已被停權，無法發言！");</script>';
            header('refresh: 0; url=class-info.php?cid='.$_POST['cid'].'#test-swipe-2');
        }
    }else if(isset($_POST['cid'])){
        echo '<script>alert("沒有權限或不正常的操作！");</script>';
        header('refresh: 0; url=class-info.php?cid='.$_POST['cid'].'#test-swipe-2');
    }else{
        header('refresh: 0; url=index.php');
    }
?>