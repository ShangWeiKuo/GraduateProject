<?php include_once("part/header.php"); ?>
<?php include_once('part/sql-connection.php') ?>

<?php
    if(isset($_SESSION['account']) && isset($_GET['type']) && isset($_GET['token']) && isset($_GET['score']) && isset($_GET['cid'])){
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
            $x = false;
            $stmt = $conn->prepare('SELECT s_score FROM score WHERE s_type = ? AND c_id = ? AND m_id = ?');
            $stmt->bind_param('ddd', $_GET['type'], $_GET['cid'], $_SESSION['m_id']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $score);
            while(mysqli_stmt_fetch($stmt)){
                $x = true;
            }
            $stmt->close();
            if($x){
                if($score === intval($_GET['score'])){
                    $stmt = $conn->prepare('DELETE FROM score WHERE s_type = ? AND c_id = ? AND m_id = ?');
                    $stmt->bind_param('ddd', $_GET['type'], $_GET['cid'], $_SESSION['m_id']);
                    mysqli_stmt_execute($stmt);
                    $stmt->close();
                }else{
                    $stmt = $conn->prepare('UPDATE score SET s_score = ? WHERE s_type = ? AND c_id = ? AND m_id = ?');
                    $stmt->bind_param('dddd', $_GET['score'], $_GET['type'], $_GET['cid'], $_SESSION['m_id']);
                    mysqli_stmt_execute($stmt);
                    $stmt->close();
                }
            }else{
                $stmt = $conn->prepare('INSERT INTO score (s_type, c_id, s_score, m_id) VALUES (?, ?, ?, ?)');
                $stmt->bind_param('dddd', $_GET['type'], $_GET['cid'], $_GET['score'], $_SESSION['m_id']);
                mysqli_stmt_execute($stmt);
                $stmt->close();
            }
            if(isset($_GET['ref'])){
                header('Refresh: 0; url=class-info.php?cid='.$_GET['ref']);
            }else{
                header('Refresh: 0; url=index.php');
            }
        }
    }else{
        if(isset($_SERVER['HTTP_REFERER'])){
            $_SESSION['ref'] = $_SERVER['HTTP_REFERER'];
        }
        echo '<script>alert("沒有權限或不正常的操作！");</script>';
        header('refresh: 0; url=login.php');
    }
?>