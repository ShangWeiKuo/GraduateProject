<?php include_once("part/sql-connection.php"); ?>
<?php include_once('function/token.php') ?>
<script>
    function reply(id){
        var elem = document.getElementById('reply_' + id);
        elem.style.display = (elem.style.display === 'none' ? 'block' : 'none');
    }
    function delete_q(id, t){
        if(confirm('確定要刪除這則評論？')){
            window.location = 'question-delete.php?qid=' + id + '&token=' + t <?php if(isset($_GET['cid'])){ echo '+ \'&ref='.$_GET['cid'].'\'';} ?>;
        }
    }
    function delete_a(id, t){
        if(confirm('確定要刪除這則回應？')){
            window.location = 'answer-delete.php?aid=' + id + '&token=' + t <?php if(isset($_GET['cid'])){ echo '+ \'&ref='.$_GET['cid'].'\'';} ?>;
        }
    }
    function delete_h(id, t){
        if(confirm('確定要刪除這個檔案？')){
            window.location = 'homework-delete.php?hid=' + id + '&token=' + t <?php if(isset($_GET['cid'])){ echo '+ \'&ref='.$_GET['cid'].'\'';} ?>;
        }
    }
    function score(id, token, s, type){
        window.location = 'score-send.php?cid=' + id + '&token=' + token + '&type=' + type + '&score=' + s <?php if(isset($_GET['cid'])){ echo '+ \'&ref='.$_GET['cid'].'\'';} ?>
    }
</script>

<?php
    $stmt = $conn->prepare('SELECT c_id, c_name, c_type, c_time, c_classroom, t_name, c_info, c_code, c_credit, c_lang, c_lang_sec FROM class_info WHERE c_id = ? AND c_delete = 0');
    $stmt->bind_param('d', $_GET['cid']);
    mysqli_stmt_execute($stmt);
    $r_t = '';
    mysqli_stmt_bind_result($stmt, $r_c_id, $r_c_name, $r_c_type, $r_t, $r_c_cr, $r_t_name, $r_c_info, $r_c_code, $r_c_cd, $r_c_lang, $r_c_lang_s);
    mysqli_stmt_fetch($stmt);
    $stmt->close();
    $stmt = $conn->prepare('SELECT concat(ct_name, "：", ct_name_sec) FROM class_type WHERE ct_id = ?');
    $stmt->bind_param('d', $r_c_type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $c_type);
    mysqli_stmt_fetch($stmt);
    $stmt->close();
?>

<div class="container class-content">
    <h5 style='font-weight: bold;'>
        <?php echo $r_c_name; ?>
    </h5>
    <div style='margin-top: 24px; margin-left: 24px;'>
        <table width="50%">
            <tr>
                <td style="font-weight: bold; width: 35%;">課程編號</td>
                <td><?php echo $r_c_code; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">學分數</td>
                <td><?php echo $r_c_cd; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">上課時間</td>
                <td>
                <?php 
                    echo $r_t;
                ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">上課教室</td>
                <td><?php echo $r_c_cr; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;"></td>
                <td style="color: #888888;"><?php echo '上課時間及教室可能隨時有異動，請以校內系統所提供資訊為主。'; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">課程分類</td>
                <td><?php echo '<a href="./class-list.php?ct='.$r_c_type.'">'.$c_type.'</a>'; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">授課教師</td>
                <td>
                <?php
                    $n_list = explode('、', $r_t_name);
                    for($i=0; $i<count($n_list)-1; $i++){
                        echo '<a href="./teacher-info.php?tname='.$n_list[$i].'">'.$n_list[$i].'</a>、';
                    }
                    echo '<a href="./teacher-info.php?tname='.$n_list[$i].'">'.$n_list[$i].'</a>';
                ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">主要授課語言</td>
                <td><?php echo $r_c_lang; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold; width: 35%;">次要授課語言</td>
                <td><?php echo $r_c_lang_s; ?></td>
            </tr>
        </table>

        <?php
            $s_style = array();
            $s_style[] = array('', '');
            $s_style[] = array('', '');
            $s_style[] = array('', '');
            if(isset($_SESSION['m_id'])){
                $stmt = $conn->prepare('SELECT s_score, s_type FROM score WHERE m_id = ? AND c_id = ?');
                $stmt->bind_param('dd', $_SESSION['m_id'], $_GET['cid']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $score, $type);
                while(mysqli_stmt_fetch($stmt)){
                    if(intval($score) === -1){
                        $s_style[$type][1] = 'color: red !important;';
                        
                    }else{
                        $s_style[$type][0] = 'color: blue !important;';
                    }
                }
                $stmt->close();
            }
            $s_score = array();
            $s_score[] = array(0, 0);
            $s_score[] = array(0, 0);
            $s_score[] = array(0, 0);
            $stmt = $conn->prepare('SELECT s_score, s_type FROM score WHERE c_id = ?');
            $stmt->bind_param('d', $_GET['cid']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $score, $type);
            while(mysqli_stmt_fetch($stmt)){
                (intval($score) === 1) ? $s_score[$type][0]++ : $s_score[$type][1]++;
            }
            $stmt->close();
        ?>

        <table style="margin-top: 16px;">
            <tr>
                <?php
                    $s_text = array('輕鬆', '有趣', '實用');
                    for($i=0; $i<3; $i++){
                ?>
                    <td style="font-weight: bold; width: 33.333%;">
                        <span style="margin-left: 16px; float: left;"><?php echo $s_text[$i] ;?><br/><?php echo $s_score[$i][0].'/'.$s_score[$i][1]; ?></span>
                        <div style="float: right; width: 80%;">
                            <a class="score" style="<?php echo $s_style[$i][0]; ?>" href="javascript: score(<?php echo $_GET['cid']; ?>, '<?php echo $token; ?>', 1, <?php echo $i; ?>);">
                                <i class="material-icons" style="opacity: 0.8; margin-left: 4%; ">exposure_plus_1</i>
                            </a>
                            <a class="score" style="<?php echo $s_style[$i][1]; ?>" href="javascript: score(<?php echo $_GET['cid']; ?>, '<?php echo $token; ?>', -1, <?php echo $i; ?>);">
                                <i class="material-icons" style="opacity: 0.8; float: right; margin-right: 20%;">exposure_neg_1</i>
                            </a>
                            <?php
                                $tmp = ($s_score[$i][0]+$s_score[$i][1] === 0) ? 0.5 : $s_score[$i][0]/($s_score[$i][0]+$s_score[$i][1]);
                            ?>
                            <div style="background-color: #666666; height: 6px; width: 80%; margin-left: 4%; border-right: 8%;">
                                <div style="background-color: #8AB4F8; height: 6px; width: <?php echo $tmp*100; ?>%;"></div>
                            </div>
                        </div>
                    </td>
                <?php
                    }
                ?>
            </tr>
        </table>
    </div>	
    <div>
        <ul id="tabs-swipe-demo" class="tabs" style="margin-top: 48px;">
            <li class="tab col s3 class-tab "><a href="#test-swipe-1">課程概述</a></li>
            <li class="tab col s3 class-tab "><a href="#test-swipe-2">評論</a></li>
            <li class="tab col s3 class-tab "><a href="#test-swipe-3">檔案</a></li>
        </ul>
        <div id="test-swipe-1" >
            <table id="comments-area" class="striped" width="50%">
                <?php
                    echo '<tr><td>';
                    echo '<p style="margin: 24px;">';
                    echo nl2br($r_c_info);
                    echo '</p>';
                    echo '</td></tr>';
                ?>
            </table>
        </div>
        <div id="test-swipe-2" >
            <table class="striped" width="50%">
                <?php
                    $level = array(50, 120, 210, 320, 450, 600);
                    $honor = array('初心者', '小有成就', '通識教室橫著走', '通識專家', '職業大學生', '通識王');
                    $color = array('#009900', '#004400', '#FF6100', '#993A00', '#BB1000', '#550000');
                    if(isset($_GET['cid'])){
                        $stmt = mysqli_prepare($conn, "SELECT q.q_id, q.m_id, q.c_id, q.q_content, m.m_account, m.m_name, q.q_time FROM question q JOIN member m ON q.m_id = m.m_id WHERE c_id = ? AND q_delete = 0 ORDER BY q_id DESC");
                        $stmt->bind_param('d', $_GET['cid']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $r0, $r1, $r2, $r3, $r4, $r5, $r6);
                        $qdata = array();
                        while(mysqli_stmt_fetch($stmt)){
                            $qdata[] = array($r0, $r1, $r2, $r3, $r4, $r5, $r6);
                        }
                        $stmt->close();
                        for($i=0; $i<count($qdata); $i++){
                            $stmt = mysqli_prepare($conn, "SELECT count(*) AS c FROM question WHERE m_id = ? AND q_delete = 0");
                            $stmt->bind_param('d', $qdata[$i][1]);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $s0);
                            mysqli_stmt_fetch($stmt);
                            $stmt->close();
                            $stmt = mysqli_prepare($conn, "SELECT count(*) AS c FROM answer WHERE m_id = ? AND a_delete = 0");
                            $stmt->bind_param('d', $qdata[$i][1]);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $s1);
                            mysqli_stmt_fetch($stmt);
                            $stmt->close();
                            $stmt = mysqli_prepare($conn, "SELECT count(*) AS c FROM homework WHERE m_id = ? AND h_delete = 0");
                            $stmt->bind_param('d', $qdata[$i][1]);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $s2);
                            mysqli_stmt_fetch($stmt);
                            $stmt->close();
                            $s3 = $s2*5 + $s0*2 + $s1;
                            echo '<tr>';
                            echo '<td>';
                            echo '<div>';
                            echo '<span style="margin-top: 8px; margin-left: 24px; margin-right: 8px; font-weight: bold; float: left;">';
                            echo htmlspecialchars($qdata[$i][5]).'（'.htmlspecialchars($qdata[$i][4]).'）';
                            echo '</span>';
                            for($j=5; $j>=0; $j--){
                                if($s3 < $level[$j]){
                                    $h = $j;
                                }
                            }
                            echo '<span style="margin-top: 9px; margin-left: -4px; margin-right: 8px;float: left; color: '.$color[$h].';">';
                            echo $honor[$h].'（'.$s3.'/'.$level[$h].'）';
                            echo '</span>';
                            echo '<span style="margin-left: 24px; margin-right: 24px; float: right;">';
                            echo $qdata[$i][6];
                            echo '</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '<p style="margin-left: 36px; margin-right: 24px; margin-top: 48px;">';
                            echo nl2br(htmlspecialchars($qdata[$i][3]));
                            echo '</p>';
                            echo '</div>';
                            echo '<div style="margin-left: 36px; margin-right: 36px;">';
                            $stmt = mysqli_prepare($conn, "SELECT a.a_id, a.m_id, a.a_content, m.m_name, m.m_account FROM answer a JOIN member m ON a.m_id = m.m_id WHERE q_id = ? AND a.a_delete = 0");
                            $stmt->bind_param('d', $qdata[$i][0]);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $r0, $r1, $r2, $r3, $r4);
                            echo '<p style="clear: both; border-bottom: 1px dotted #999999; float: none; margin-bottom: 12px; padding-top: 12px;"></p>';
                            while(mysqli_stmt_fetch($stmt)){
                                echo '<p style="margin-top: -4px;">';
                                echo '<span style="font-weight: bold;">'.htmlspecialchars($r3).'（'.$r4.'）</span>：'.htmlspecialchars($r2);
                                if(isset($_SESSION['m_id'])){
                                    if($r1 === $_SESSION['m_id']){
                                        echo '<a href="javascript:delete_a('.$r0.', \''.$token.'\');"><i class="material-icons" style="margin-top: 4px; float: right;">delete_outline</i></a>';
                                    }
                                }
                                echo '</p>';
                            }
                            echo '</div>';
                            if(isset($_SESSION['account'])){
                                echo '<div>';
                                echo '<p style="clear: both;">';
                                if($qdata[$i][4] !== $_SESSION['account']){
                                    //echo '<a class="waves-effect waves-light btn" style="margin-right: 24px; float: right;" href="#">檢舉</a>';
                                    echo '<a class="waves-effect waves-light btn" style="margin-right: 12px; float: right;" onclick="reply('.$qdata[$i][0].');">回應</a>';
                                }else{
                                    echo '<a class="waves-effect waves-light btn" style="margin-right: 24px; float: right;" onclick="delete_q('.$qdata[$i][0].', \''.$token.'\');">刪除</a>';
                                    echo '<a class="waves-effect waves-light btn" style="margin-right: 12px; float: right;" onclick="reply('.$qdata[$i][0].');">回應</a>';
                                }
                                echo '</p>';
                                echo '</div>';
                                echo '<form action="answer-post.php" method="POST">';
                                echo '<div style="padding: 12px; display: none;" id="reply_'.$qdata[$i][0].'">';
                                //echo '<p style="clear: both; border-bottom: 1px dotted #999999; float: none; margin-bottom: 12px; padding-top: 12px;"></p>';
                                echo '<input type="text" name="content" placeholder="發表回應..." style="width: 80%; margin-left: 24px; clear:both; float: left;" required/>';
                                echo '<input type="submit" class="waves-effect waves-light btn" href="#" style="float: right; margin-right: 24px; margin-top: 12px;" value="送出">';
                                echo '<input name="qid" value="'.$qdata[$i][0].'" hidden/>';
                                echo '<input name="cid" value="'.$_GET['cid'].'" hidden/>';
                                echo '</div>';
                                echo '</form>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                <?php
                    if(isset($_SESSION['account'])){
                ?>
                        <tr>
                            <td>
                                <form action="question-post.php" method="POST">
                                    <div style="margin-left: 16px; margin-right: 16px;">
                                        <textarea class="materialize-textarea" name="content" placeholder="發表評論..." style="display: inline; width: 80%; padding: 0 0 0 0;" required/></textarea>
                                        <input name="cid" value=<?php if(isset($_GET['cid'])){echo '"'.$_GET['cid'].'"';} ?> hidden/>
                                        <input type="submit" class="waves-effect waves-light btn" href="#" style="float: right; margin-right: 12px; margin-top: 12px;" value="送出"> 
                                    </div>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </table>
        </div>
        <div id="test-swipe-3" >
            <table class="striped" width="50%">
                <?php
                    $stmt = mysqli_prepare($conn, "SELECT m.m_name, m.m_account, h.h_id, h.h_file, h.h_name, h.h_time, h.m_id FROM homework h JOIN member m ON h.m_id = m.m_id WHERE c_id = ? AND h.h_delete = 0 ORDER BY h_time DESC");
                    $stmt->bind_param('d', $_GET['cid']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $r0, $r1, $r2, $r3, $r4, $r5, $r6);
                    $qdata = array();
                    while(mysqli_stmt_fetch($stmt)){
                        $qdata[] = array($r0, $r1, $r2, $r3, $r4, $r5, $r6);
                    }
                    $stmt->close();
                    for($i=0; $i<count($qdata); $i++){
                ?>
                        <tr>
                            <td>
                                <div>
                                    <span style="margin-top: 8px; margin-left: 24px; margin-right: 8px; font-weight: bold; float: left;">
                                        <?php echo htmlspecialchars($qdata[$i][0]); ?>（<?php echo $qdata[$i][1]; ?>）
                                    </span>
                                    <?php
                                    $stmt = mysqli_prepare($conn, "SELECT count(*) AS c FROM question WHERE m_id = ? AND q_delete = 0");
                                    $stmt->bind_param('d', $qdata[$i][6]);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $s0);
                                    mysqli_stmt_fetch($stmt);
                                    $stmt->close();
                                    $stmt = mysqli_prepare($conn, "SELECT count(*) AS c FROM answer WHERE m_id = ? AND a_delete = 0");
                                    $stmt->bind_param('d', $qdata[$i][6]);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $s1);
                                    mysqli_stmt_fetch($stmt);
                                    $stmt->close();
                                    $stmt = mysqli_prepare($conn, "SELECT count(*) AS c FROM homework WHERE m_id = ? AND h_delete = 0");
                                    $stmt->bind_param('d', $qdata[$i][6]);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $s2);
                                    mysqli_stmt_fetch($stmt);
                                    $stmt->close();
                                    $s3 = $s2*5 + $s0*2 + $s1;
                                        for($j=5; $j>=0; $j--){
                                            if($s3 < $level[$j]){
                                                $h = $j;
                                            }
                                        }
                                        echo '<span style="margin-top: 9px; margin-left: -4px; margin-right: 8px;float: left; color: '.$color[$h].';">';
                                        echo $honor[$h].'（'.$s3.'/'.$level[$h].'）';
                                        echo '</span>';
                                    ?>
                                    <span style="margin-left: 24px; margin-right: 24px; float: right;">
                                        <?php echo $qdata[$i][5]; ?>
                                    </span>
                                </div>
                                <p style="clear: both; margin-left: 36px; margin-right: 24px; float: left;">
                                    <a href="<?php echo $qdata[$i][3]; ?>">
                                        <i class="material-icons">file_download</i>
                                        <?php echo $qdata[$i][4]; ?>
                                    </a>
                                </p>
                                <?php
                                    if(isset($_SESSION['account'])){
                                        if($qdata[$i][1] === $_SESSION['account']){
                                            echo '<a class="waves-effect waves-light btn" style="margin-right: 24px; float: right;" onclick="delete_h('.$qdata[$i][2].', \''.$token.'\');">刪除</a>';
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                <?php if(isset($_SESSION['account'])){ ?>
                    <tr>
                        <td>
                            <form action="doAction.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="myFile" accept="image/jpeg,image/jpg,image/gif,image/png" style="display: block; margin-bottom: 5px; margin-top: 12px; margin-left: 12px;">
                                <input type="hidden" name="MAX_FILE_SIZE" value="16777216">
                                <input type="hidden" name="cid" value=<?php if(isset($_GET['cid'])){echo '"'.$_GET['cid'].'"';} ?>>
                                <input type="submit" class="waves-effect waves-light btn-large" style="float: right; margin-top: -44px; margin-right: 12px;" value="上傳檔案">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
