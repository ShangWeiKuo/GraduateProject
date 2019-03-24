<?php include_once("part/header.php"); ?>
<?php include_once('part/sql-connection.php'); ?>
<?php
    if(isset($_GET['a']) && isset($_GET['t'])){
        $t2 = $_GET['t'];
        $stmt = $conn->prepare('DELETE FROM verification WHERE expired <= ?');
        $stmt->bind_param('d', time());
        mysqli_stmt_execute($stmt);
        $stmt->close();
        $stmt = $conn->prepare('SELECT account FROM verification WHERE account = ? AND token = ?');
        $stmt->bind_param('ss', $_GET['a'], $_GET['t']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r);
        mysqli_stmt_fetch($stmt);
        $ac = $r;
        $stmt->close();
        if($ac){
            $stmt = $conn->prepare('DELETE FROM verification WHERE account = ? AND token = ?');
            $stmt->bind_param('s', $_GET['a'], $_GET['t']);
            mysqli_stmt_execute($stmt);
            $stmt->close();
            $stmt = $conn->prepare('UPDATE member SET m_status = 1 WHERE m_account = ?');
            $stmt->bind_param('s', $ac);
            mysqli_stmt_execute($stmt);
            $stmt->close();
            echo '<script>alert(\''.$ac.'，恭喜您認證成功！\');</script>';
            $_SESSION['account'] = $_GET['a'];
            header('refresh: 0; url=index.php');
        }
    }else{
        echo '<script>alert(\'不正常的操作，或是認證信已經過期。\');</script>';
        header('refresh: 0; url=index.php');
    }
?>