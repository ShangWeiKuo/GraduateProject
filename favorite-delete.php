<?php include_once("part/header.php"); ?>
<?php include_once('part/sql-connection.php') ?>

<?php

    if(isset($_GET['fid']) && isset($_GET['token']) && isset($_SESSION['account'])){
        $stmt = $conn->prepare('SELECT m_id FROM favorite WHERE f_id = ?');
        $stmt->bind_param('d', $_GET['fid']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r0);
        mysqli_stmt_fetch($stmt);
        $stmt->close();

        // Check token is correct
        $stmt = $conn->prepare('SELECT token FROM token WHERE token = ?');
        $stmt->bind_param('s', $_GET['token']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r);
        $token_c = false;
        while(mysqli_stmt_fetch($stmt)){
            $token_c = true;
        }
        $stmt->close();

        if(!$token_c || $r0 !== $_SESSION['m_id']){
            echo '<script>alert("連線逾時或不正常的操作，請重新操作。")</script>';
            header('Refresh: 0; url=index.php');
        }else{
            $stmt = $conn->prepare('DELETE FROM favorite WHERE f_id = ? AND m_id = ?');
            $stmt->bind_param('dd', $_GET['fid'], $_SESSION['m_id']);
            mysqli_stmt_execute($stmt);
            $stmt->close(); 
            header('Refresh: 0; url=member-timetable.php');
        }
    }else{
        echo '<script>alert("沒有權限或不正常的操作！");</script>';
        header('refresh: 0; url=index.php');
    }
?>