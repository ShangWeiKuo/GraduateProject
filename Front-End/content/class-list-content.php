<?php include_once("part/sql-connection.php"); ?>
<?php include_once('function/token.php') ?>
<script>
    function add_f(id, t, n){
        if(confirm('確定要將「' + n + '」加入我的最愛？')){
            window.location = 'favorite-add.php?cid=' + id + '&token=' + t <?php if(isset($_GET['ct'])){ echo '+ \'&ref='.$_GET['ct'].'\'';} ?>;
        }
    }
</script>
<div class="container">
    <ul class="collection with-header">
        <nav>
            <div class="nav-wrapper grey lighten-4 grey-text text-darken-1">
                <div class="col s12 grey-text text-darken-1  ">
                    <div class="breadcrumb-box">
                        <?php
                            if(isset($_GET['ct'])){
                                $stmt = $conn->prepare('SELECT ct_name, ct_name_sec FROM class_type WHERE ct_id = ?');
                                $stmt->bind_param('d', $_GET['ct']);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $ct_name, $ct_name_sec);
                                mysqli_stmt_fetch($stmt);
                                echo '<a href="" class="breadcrumb grey-text text-darken-1">';
                                echo $ct_name;
                                echo '</a>';
                                echo '<a href="" class="breadcrumb grey-text text-darken-1">';
                                echo $ct_name_sec;
                                echo '</a>';
                                $stmt->close();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <li class="collection-header collection-title">
            <h4>課程列表</h4>
        </li>
        <?php
            if(isset($_GET['ct'])){
                $stmt = $conn->prepare('SELECT c_id, c_name, t_name FROM class_info WHERE c_type = ? AND c_delete = 0');
                $stmt->bind_param('d', $_GET['ct']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $r_c_id, $r_c_name, $r_t_name);
                while(mysqli_stmt_fetch($stmt)){
                    echo '<li class="collection-item">';
                    echo '<div>';
                    $n_list = explode('、', $r_t_name);
                    for($i=0; $i<count($n_list)-1; $i++){
                        echo '<a href="./teacher-info.php?tname='.$n_list[$i].'">'.$n_list[$i].'</a></br>';
                    }
                    echo '<a href="./teacher-info.php?tname='.$n_list[$i].'">'.$n_list[$i].'</a>';
                    echo '<a href="./class-info.php?cid='.$r_c_id.'" style="margin-left: 24px";>'.$r_c_name.'</a>';
                    echo '<a href="#!" class="secondary-content">';
                    echo '<i class="material-icons" onclick="add_f('.$r_c_id.', \''.$token.'\',\''.$r_c_name.'\')">favorite</i>';
                    echo '</a>';
                    echo '</div>';
                    echo '</li>';
                }
            }
            $conn->close();
        ?>
    </ul>
</div>