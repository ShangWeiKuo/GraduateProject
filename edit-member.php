<?php include_once("part/header.php"); ?>
<?php include_once('function/pw-hash.php') ?>
<?php include_once('part/sql-connection.php') ?>
<?php
    $edit_check = true;

    if(isset($_POST['old_password']) && isset($_POST['email']) && isset($_POST['token'])){
        $_POST['email'] = strtolower($_POST['email']);
        $stmt = $conn->prepare('SELECT m_password FROM member WHERE m_account = ?');
        $stmt->bind_param('s', $_SESSION['account']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r0);
        mysqli_stmt_fetch($stmt);
        $stmt->close();
        if($_POST['password'] !== $_POST['password-confirm']){
            $edit_check = false;
            echo '<script>alert("新密碼欄位不符！請重新輸入")</script>';
            header('Refresh: 0; url=member-page.php');
        }else if(isset($_POST['password']) && $_POST['password'] !== '' && (strlen($_POST['password']) < 4 || strlen($_POST['password']) > 32)){
            $edit_check = false;
            echo '<script>alert("僅能使用 4 ~ 32 位之組合作為密碼！請重新輸入")</script>';
            header('Refresh: 0; url=member-page.php');
        }else if(pw_hash($_POST['old_password']) !== $r0){
            $edit_check = false;
            echo '<script>alert("舊密碼不符！請重新輸入")</script>';
            header('Refresh: 0; url=member-page.php');
        }else if(!strpos($_POST['email'], '@mail.nuk.edu.tw') && !strpos($_POST['email'], '@nuk.edu.tw')){
            $edit_check = false;
            echo '<script>alert("請使用校內信箱！")</script>';
            header('Refresh: 0; url=member-page.php');
        }else{
            if(!isset($_POST['nickname']) || $_POST['nickname'] === ''){
                $_POST['nickname'] = $_SESSION['account'];
            }

            // Check token is correct
            $stmt = $conn->prepare('SELECT token FROM token WHERE token = ?');
            $stmt->bind_param('s', $_POST['token']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $r);
            $token_c = false;
            while(mysqli_stmt_fetch($stmt)){
                $token_c = true;
            }
            if(!$token_c){
                $edit_check = false;
                echo '<script>alert("連線逾時或不正常的操作，請重新操作。")</script>';
                header('Refresh: 0; url=member-page.php');
            }
            $stmt->close();

            // Delete token
            $stmt = $conn->prepare('DELETE FROM token WHERE token = ?');
            $stmt->bind_param('s', $_POST['token']);
            mysqli_stmt_execute($stmt);
            $stmt->close();

            // Edit
            if($edit_check){
                if($_POST['password'] === ''){
                    $hash = pw_hash($_POST['old_password']);
                }else{
                    $hash = pw_hash($_POST['password']);
                }
                $stmt = $conn->prepare('UPDATE member SET m_password = ?, m_name = ?, m_email = ? WHERE m_account = ?');
                $stmt->bind_param('ssss', $hash, $_POST['nickname'], $_POST['email'], $_SESSION['account']);
                mysqli_stmt_execute($stmt);
                $stmt->close();
                if($_POST['password'] !== $_POST['old_password'] && isset($_POST['password']) && $_POST['password'] !== ''){
                    echo '<script>alert(\'修改成功！請使用新密碼重新登入。\')</script>';
                    unset($_SESSION['account']);
                }else{
                    echo '<script>alert(\'修改成功！將回到首頁。\')</script>';
                }
                header('refresh: 0; url=index.php');
            }
        }
    }else{
        echo '<script>alert("請填入完整資料！")</script>';
        header('Refresh: 0; url=member-page.php');
    }
?>