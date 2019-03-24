<?php include_once("part/header.php"); ?>
<?php include_once('function/pw-hash.php') ?>
<?php include_once('part/sql-connection.php') ?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    $reg_check = true;

    if(isset($_POST['account']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) && isset($_POST['token'])){
        $_POST['account'] = strtolower($_POST['account']);
        $_POST['email'] = strtolower($_POST['email']);
        $back = '';
        if(isset($_POST['nickname']) && $_POST['nickname'] !== ''){
            $back = '&nickname='.$_POST['nickname'];
        }
        if($_POST['password'] !== $_POST['password-confirm']){
            $reg_check = false;
            echo '<script>alert("密碼欄位不符！請重新輸入");</script>';
            header('Refresh: 0; url=register.php?account='.$_POST['account'].'&email='.$_POST['email'].$back);
        }else if(!preg_match('/^[A-Za-z0-9]+$/', $_POST['account'])){
            $reg_check = false;
            echo '<script>alert("僅能使用英文數字之組合作為帳號！請重新輸入");</script>';
            header('Refresh: 0; url=register.php?account='.$_POST['account'].'&email='.$_POST['email'].$back);
        }else if(strlen($_POST['account']) < 4 || strlen($_POST['account']) > 16){
            $reg_check = false;
            echo '<script>alert("僅能使用 4 ~ 16 位之組合作為帳號！請重新輸入");</script>';
            header('Refresh: 0; url=register.php?account='.$_POST['account'].'&email='.$_POST['email'].$back);
        }else if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 32){
            $reg_check = false;
            echo '<script>alert("僅能使用 4 ~ 32 位之組合作為密碼！請重新輸入");</script>';
            header('Refresh: 0; url=register.php?account='.$_POST['account'].'&email='.$_POST['email'].$back);
        }else if(!strpos($_POST['email'], '@mail.nuk.edu.tw') && !strpos($_POST['email'], '@nuk.edu.tw')){
            $reg_check = false;
            echo '<script>alert("請使用校內信箱！");</script>';
            header('Refresh: 0; url=register.php?account='.$_POST['account'].'&email='.$_POST['email'].$back);
        }else{
            if(!isset($_POST['nickname']) || $_POST['nickname'] === ''){
                $_POST['nickname'] = $_POST['account'];
            }

            // Check registed status
            $stmt = $conn->prepare('SELECT m_id FROM member WHERE m_account = ? OR m_email = ?');
            $stmt->bind_param('ss', $_POST['account'], $_POST['email']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $r);
            while(mysqli_stmt_fetch($stmt)){
                $reg_check = false;
                echo '<script>alert("此帳號或信箱已有人註冊！")</script>';
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
                $reg_check = false;
                echo '<script>alert("連線逾時或不正常的操作，請重新註冊。")</script>';
                header('Refresh: 0; url=register.php');
            }
            $stmt->close();

            // Delete token
            $stmt = $conn->prepare('DELETE FROM token WHERE token = ?');
            $stmt->bind_param('s', $_POST['token']);
            mysqli_stmt_execute($stmt);
            $stmt->close();

            // Register
            if($reg_check){
                $hash = pw_hash($_POST['password']);
                $stmt = $conn->prepare('INSERT INTO member (m_account, m_password, m_name, m_email) VALUES (?, ?, ?, ?)');
                $stmt->bind_param('ssss', $_POST['account'], $hash, $_POST['nickname'], $_POST['email']);
                mysqli_stmt_execute($stmt);
                $stmt->close();

                $_SESSION['account'] = $_POST['account'];
                $token = md5(uniqid(rand()));
                $stmt = $conn->prepare('INSERT INTO verification (account, token, expired) VALUES (?, ?, ?)');
                $expired = time() + 86400;
                $stmt->bind_param('ssd', $_SESSION['account'], $token, $expired);
                mysqli_stmt_execute($stmt);
                $stmt->close();

                $stmt = $conn->prepare('SELECT m_id FROM member WHERE m_account = ?');
                $stmt->bind_param('s', $_POST['account']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $r0);
                while(mysqli_stmt_fetch($stmt)){
                    $login = true;
                }
                if($login){
                    $_SESSION['m_id'] = $r0;
                }

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

                    $link = 'https://allpass.info/verify.php?a='.$_POST['account'].'&t='.$token;
                    $mail->isHTML(true);
                    $mail->Subject = 'Allpass Verification';
                    $mail->Body    = '您好，'.$_POST['account'].'：</br>恭喜您成功註冊！</br>接下來只要進行驗證，即可完成權限開通的手續：</br><a href="'.$link.'">'.$link.'</a>';
                    $mail->AltBody = '';

                    $mail->send();
                    echo '<script>alert(\'驗證信已寄出！請至信箱收取並點選驗證連結以完成權限開通。\n（若找不到該信件，請確實檢查垃圾郵件匣）\')</script>';
                } catch (Exception $e) {
                    echo '<script>alert(\'處理驗證信時出現了錯誤：'.$mail->ErrorInfo.'\')</script>';
                }
                header('refresh: 0; url=index.php');
            }
        }
    }else{
        echo '<script>alert("請填入完整資料！")</script>';
        header('Refresh: 0; url=register.php');
    }
?>