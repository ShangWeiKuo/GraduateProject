<?php include_once("part/header.php"); ?>
<?php include_once('function/pw-hash.php') ?>
<?php include_once('part/sql-connection.php') ?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    $reset_check = true;

    if(isset($_POST['account']) && isset($_POST['email']) && isset($_POST['token'])){
        $_POST['account'] = strtolower($_POST['account']);
        $_POST['email'] = strtolower($_POST['email']);

        // Check registed status
        $stmt = $conn->prepare('SELECT m_id FROM member WHERE m_account = ? AND m_email = ?');
        $stmt->bind_param('ss', $_POST['account'], $_POST['email']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $r);
        if(!mysqli_stmt_fetch($stmt)){
            $reset_check = false;
            echo '<script>alert(0);</script>';
            echo '<script>帳號或信箱不正確！</script>';
            header('Refresh: 0; url=register.php');
        }
        $stmt->close();
        
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
            $reset_check = false;
            echo '<script>alert(1);</script>';
            echo '<script>alert("連線逾時或不正常的操作，請重新註冊。")</script>';
            header('Refresh: 0; url=register.php');
        }
        $stmt->close();

        // Delete token
        $stmt = $conn->prepare('DELETE FROM token WHERE token = ?');
        $stmt->bind_param('s', $_POST['token']);
        mysqli_stmt_execute($stmt);
        $stmt->close();

        // Reset
        if($reset_check){
            $new_password = '';
            $characters = '23456789abcdefghijkmnpqrstuvwxyz';
            $randomString = '';
            for ($i=0; $i<6; $i++) {
                $new_password .= $characters[rand(0, 31)];
            }
            $token = md5(uniqid(rand()));
            $stmt = $conn->prepare('INSERT INTO verification (account, token, expired, exdata) VALUES (?, ?, ?, ?)');
            $expired = time() + 86400;
            $stmt->bind_param('ssds', $_POST['account'], $token, $expired, pw_hash($new_password));
            mysqli_stmt_execute($stmt);
            $stmt->close();
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'a1043311@mail.nuk.edu.tw';
                $mail->Password = 'r124616069';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('a1043311@mail.nuk.edu.tw', 'Allpass');
                $mail->addAddress($_POST['email']);

                $link = 'https://allpass.info/reset-password-finish.php?a='.$_POST['account'].'&t='.$token;
                $mail->isHTML(true);
                $mail->Subject = 'Allpass Password Reset';
                
                $mail->Body    = '您好，'.$_POST['account'].'：</br>您的密碼將重設為：'.$new_password.'</br>點擊此連結即可生效：</br><a href="'.$link.'">'.$link.'</a></br></br>若您沒有進行此操作，請忽略本信件。';
                $mail->AltBody = '';

                $mail->send();
                echo '<script>alert(\'密碼重設信已寄出！請至信箱收取並點選驗證連結以完成重設手續。\n（若找不到該信件，請確實檢查垃圾郵件匣）\')</script>';
            } catch (Exception $e) {
                echo '<script>alert(\'處理驗證信時出現了錯誤：'.$mail->ErrorInfo.'\')</script>';
            }
            header('refresh: 0; url=index.php');
        }
    }else{
        echo '<script>alert("請填入完整資料！")</script>';
        header('Refresh: 0; url=register.php');
    }
?>