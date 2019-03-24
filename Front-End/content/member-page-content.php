<?php include_once('part/sql-connection.php') ?>
<?php include_once('function/token.php') ?>
<script>
    function delete_q(id, t){
        if(confirm('確定要刪除這則評論？')){
            window.location = 'question-delete.php?qid=' + id + '&token=' + t;
        }
    }
    function delete_a(id, t){
        if(confirm('確定要刪除這則回應？')){
            window.location = 'answer-delete.php?aid=' + id + '&token=' + t;
        }
    }
    function delete_h(id, t){
        if(confirm('確定要刪除這個檔案？')){
            window.location = 'homework-delete.php?hid=' + id + '&token=' + t <?php if(isset($_GET['cid'])){ echo '+ \'&ref='.$_GET['cid'].'\'';} ?>;
        }
    }
</script>
<div class="container">
    <div>
        <ul id="tabs-swipe-demo " class="tabs">
            <li class="tab col s3 member-tab"><a href="#test-swipe-1">發言紀錄</a></li>
            <li class="tab col s3 member-tab"><a href="#test-swipe-2">檔案</a></li>
            <li class="tab col s3 member-tab"><a href="#test-swipe-3">個人資料</a></li>
        </ul>
        <div id="test-swipe-1" >
            <table class="striped" width="50%">
                <?php
                    if(isset($_SESSION['m_id'])){
                        $stmt = mysqli_prepare($conn, "SELECT q.q_id, q.m_id, q.c_id, q.q_content, q.q_time, ci.c_name, ci.t_name FROM question q JOIN class_info ci ON q.c_id = ci.c_id WHERE m_id = ? AND q_delete = 0 ORDER BY q_id DESC");
                        $stmt->bind_param('d', $_SESSION['m_id']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $r0, $r1, $r2, $r3, $r4, $r5, $r6);
                        while(mysqli_stmt_fetch($stmt)){
                            echo '<tr>';
                            echo '<td>';
                            echo '<p style="margin-left: 24px; margin-right: 8px; font-weight: bold;">';
                            echo '<a href="/class-info.php?cid='.$r2.'#test-swipe-2">'.$r6.'　'.$r5.'</a>';
                            echo '　（Q）';
                            echo '　';
                            echo '</p><p style="margin-left: 36px; margin-right: 24px; margin-top: -16px;">';
                            echo $r4;
                            echo '</p><p style="margin-left: 36px; margin-right: 24px; margin-top: 16px;">';
                            echo htmlspecialchars($r3);
                            echo '</p>';
                            echo '<p style="margin-right: 24px; margin-top: -8px; float: right;">';
                            //echo '<a class="waves-effect waves-light btn" style="margin-right: 8px;" href="#">修改</a>';
                            echo '<a class="waves-effect waves-light btn" onclick="delete_q('.$r0.', \''.$token.'\');">刪除</a>';
                            echo '</p>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $stmt->close();
                        $stmt = mysqli_prepare($conn, "SELECT a.a_id, a.m_id, a.a_id, a.a_content, a.a_time, ci.c_name, ci.t_name FROM answer a JOIN class_info ci ON a.c_id = ci.c_id WHERE m_id = ? AND a_delete = 0 ORDER BY a_id DESC");
                        $stmt->bind_param('d', $_SESSION['m_id']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $r0, $r1, $r2, $r3, $r4, $r5, $r6);
                        while(mysqli_stmt_fetch($stmt)){
                            echo '<tr>';
                            echo '<td>';
                            echo '<p style="margin-left: 24px; margin-right: 8px; font-weight: bold;">';
                            echo '<a href="/class-info.php?cid='.$r2.'#test-swipe-2">'.$r6.'　'.$r5.'</a>';
                            echo '　（A）';
                            echo '　';
                            echo '</p><p style="margin-left: 36px; margin-right: 24px; margin-top: -16px;">';
                            echo $r4;
                            echo '</p><p style="margin-left: 36px; margin-right: 24px; margin-top: 16px;">';
                            echo htmlspecialchars($r3);
                            echo '</p>';
                            echo '<p style="margin-right: 24px; margin-top: -8px; float: right;">';
                            //echo '<a class="waves-effect waves-light btn" style="margin-right: 8px;" href="#">修改</a>';
                            echo '<a class="waves-effect waves-light btn" onclick="delete_a('.$r0.', \''.$token.'\');">刪除</a>';
                            echo '</p>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $stmt->close();
                    }
                ?>
            </table>
        </div>
        <div id="test-swipe-2" >
        <table class="striped" width="50%">
                <?php
                    $stmt = mysqli_prepare($conn, "SELECT h.h_id, h.m_id, h.c_id, h.h_file, h.h_name, ci.c_name, ci.t_name, h.h_time FROM homework h JOIN class_info ci ON h.c_id = ci.c_id WHERE m_id = ? AND h_delete = 0 ORDER BY h.h_time DESC");
                    $stmt->bind_param('d', $_SESSION['m_id']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $r0, $r1, $r2, $r3, $r4, $r5, $r6, $r7);
                    while(mysqli_stmt_fetch($stmt)){
                        echo '<tr>';
                        echo '<td>';
                        echo '<p style="margin-left: 24px; margin-right: 8px; font-weight: bold;">';
                        echo '<a href="/class-info.php?cid='.$r2.'#test-swipe-2">'.$r6.'　'.$r5.'</a>';
                        echo '</p><p style="margin-left: 36px; margin-right: 24px; margin-top: -16px;">';
                        echo $r7;
                        echo '</p><p style="margin-left: 36px; margin-right: 24px; margin-top: 16px;">';
                        echo '<a href="'.$r3.'"><i class="material-icons">file_download</i>'.$r4.'</a>';
                        echo '</p>';
                        echo '<p style="margin-right: 24px; margin-top: -8px; float: right;">';
                        //echo '<a class="waves-effect waves-light btn" style="margin-right: 8px;" href="#">修改</a>';
                        echo '<a class="waves-effect waves-light btn" onclick="delete_h('.$r0.', \''.$token.'\');">刪除</a>';
                        echo '</p>';
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
        <div id="test-swipe-3">
            <table class="striped" width="50%">
                <tr>
                    <td>
                        <div class="login-box" style="padding-top: 0;">
                            <form action='/edit-member.php' method='POST'>
                                <div class="login-content">
                                    <?php
                                        $stmt = $conn->prepare('SELECT m_name, m_email FROM member WHERE m_account = ?');
                                        $stmt->bind_param('s', $_SESSION['account']);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $r0, $r1);
                                        mysqli_stmt_fetch($stmt);
                                    ?>
                                    <div class="row">
                                        <div class="input-field">
                                            <i name="account-i" class="material-icons prefix">account_circle</i>
                                            <input name="account" id="icon_prefix" type="text" class="validate" placeholder="帳號" value="<?php echo($_SESSION['account']); ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <i name="email-i" class="material-icons prefix">email</i>
                                            <input name="email" id="icon_prefix" type="text" class="validate" placeholder="電子信箱" value="<?php echo($r1); ?>" required/>
                                            <span name="span-error1" style="color: #FF0000; display: none;">
                                                請填寫電子信箱。
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <i name="lock-i0" class="material-icons prefix">lock</i>
                                            <input name="old_password" id="icon_prefix" type="password" class="validate" placeholder="舊密碼" required/>
                                            <span name="span-error2" style="color: #FF0000; display: none;">
                                                請填寫舊密碼。
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <i name="lock-i1" class="material-icons prefix">lock_outline</i>
                                            <input name="password" id="icon_prefix" type="password" class="validate" placeholder="新密碼（若不需修改密碼可不填）" />
                                            <span name="span-error2" style="color: #FF0000; display: none;">
                                                請填寫 4 ~ 32 位之組合作為密碼。
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <i name="lock-i2" class="material-icons prefix">lock_outline</i>
                                            <input name="password-confirm" id="icon_prefix" type="password" class="validate" placeholder="確認新密碼（若不需修改密碼可不填）" />
                                            <span name="span-error3" style="color: #FF0000; display: none;">
                                                請再次確認密碼。
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field">
                                            <i class="material-icons prefix">face</i>
                                            <input name="nickname" id="icon_prefix" type="text" class="validate" placeholder="暱稱（可選，不建議使用學號）" value="<?php echo($r0); ?>" onfocus="check(4);" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="token" value='<?php echo $token; ?>' />
                                    <input name="sbt" type="submit" class="waves-light btn right cyan lighten-2" value="修改"/>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>