<?php include_once("../part/sql-connection.php"); ?>
<?php include_once("../function/pw-hash.php"); ?>
<?php
    session_start();
    if(isset($_POST['account']) && isset($_POST['password']))
    {
        $stmt = $conn->prepare('SELECT m_id, m_account, m_password FROM member WHERE m_account = ? AND m_password = ?');
        $stmt->bind_param('ss', $_POST['account'], pw_hash($_POST['password']));
        $login = false;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r0, $r1, $r2);
        while(mysqli_stmt_fetch($stmt)){
            $login = true;
        }
        if($login){
            if(strtolower($_POST['account']) !== 'admin'){
                $_SESSION['account'] = $_POST['account'];
                $_SESSION['m_id'] = $r0;
                if(isset($_SESSION['ref'])){
                    $r = $_SESSION['ref'];
                    unset($_SESSION['ref']);
                    header('Location: '.$r);
                }else if(isset($_POST['ref'])){
                    header('Location: '.$_POST['ref']);
                }else{
                    header('Location: ../index.php');
                }
            }else{
                $_SESSION['account'] = $_POST['account'];
                $_SESSION['m_id'] = $r0;
                header('Location: ../backend-index.php');
            }
        }else{
            header('Location: ../login.php?f=1');
        }
    }
?>
