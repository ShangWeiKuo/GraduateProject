<?php include_once("part/sql-connection.php"); ?>
<?php include_once('function/token.php') ?>
<script>
    function add_f(id, t, n){
        if(confirm('確定要將「' + n + '」加入我的最愛？')){
            window.location = 'favorite-add.php?cid=' + id + '&token=' + t <?php if(isset($_GET['ct'])){ echo '+ \'&ref='.$_GET['ct'].'\'';} ?>;
        }
    }
</script>
<div class="container index-content">
    <ul class="collection with-header">
        <nav>
            <div class="nav-wrapper grey lighten-4 grey-text text-darken-1">
                <div class="col s12 grey-text text-darken-1">
                    <div class="breadcrumb-box">
                        <a href="" class="breadcrumb grey-text text-darken-1">搜尋</a>
                        <?php
                            if(isset($_GET['tname'])){
                                echo '<a href="" class="breadcrumb grey-text text-darken-1">';
                                echo htmlspecialchars($_GET['tname']);
                                echo '</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <li class="collection-header">
            <h4>課程列表</h4>
        </li>
        <?php
            if(isset($_GET['tname'])){
                $stmt = $conn->prepare('SELECT c_id, c_name, t_name, c_code FROM class_info WHERE (t_name LIKE ? OR c_name LIKE ? OR c_code LIKE ?) AND c_delete = 0');
                $str = '%'.$_GET['tname'].'%';
                $stmt->bind_param('sss', $str, $str, $str);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $r_c_id, $r_c_name, $r_t_name, $r_c_code);
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