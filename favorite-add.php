<?php include_once("part/header.php"); ?>
<?php include_once('part/sql-connection.php') ?>

<?php

    if(isset($_GET['cid']) && isset($_GET['token']) && isset($_SESSION['account'])){
        $stmt = $conn->prepare('SELECT f_id FROM favorite WHERE c_id = ? AND m_id = ?');
        $stmt->bind_param('ds', $_GET['cid'], $_SESSION['m_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r0);
        $x = mysqli_stmt_fetch($stmt);
        $stmt->close();
        if(!$x){
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

            if(!$token_c){
                echo '<script>alert("連線逾時或不正常的操作，請重新操作。")</script>';
                header('Refresh: 0; url=index.php');
            }else{
                $stmt = $conn->prepare('INSERT INTO favorite (m_id, c_id) VALUES (?, ?)');
                $stmt->bind_param('dd', $_SESSION['m_id'], $_GET['cid']);
                mysqli_stmt_execute($stmt);
                $stmt->close();
            }
        }
        if(isset($_GET['ref'])){
            header('Refresh: 0; url=class-list.php?ct='.$_GET['ref']);
        }else{
            header('Refresh: 0; url=member-timetable.php');
        }
    }else{
        if(isset($_SERVER['HTTP_REFERER'])){
            $_SESSION['ref'] = $_SERVER['HTTP_REFERER'];
        }
        echo '<script>alert("沒有權限或不正常的操作！");</script>';
        header('refresh: 0; url=login.php');
    }
?>