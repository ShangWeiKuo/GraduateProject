<?php include_once("part/sql-connection.php"); ?>
<?php include_once('function/token.php') ?>
<script>
    function delete_f(id, t, n){
        if(confirm('確定要將「' + n + '」從我的最愛移除？')){
            window.location = 'favorite-delete.php?fid=' + id + '&token=' + t;
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
                            if(isset($_SESSION['m_id'])){
                                echo '<a href="" class="breadcrumb grey-text text-darken-1">';
                                echo '我的最愛';
                                echo '</a>';
                                echo '<a href="" class="breadcrumb grey-text text-darken-1">';
                                echo '</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <li class="collection-header collection-title">
            <h4>我的最愛</h4>
        </li>
        <?php
            if(isset($_SESSION['m_id'])){
                $stmt = $conn->prepare('SELECT c.c_id, c.t_name, c.c_name, f.f_id FROM favorite f JOIN class_info c ON f.c_id = c.c_id WHERE m_id = ? AND c.c_delete = 0');
                $stmt->bind_param('d', $_SESSION['m_id']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $r_c_id, $r_t_name, $r_c_name, $f);
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
                    echo '<i class="material-icons" onclick="delete_f('.$f.', \''.$token.'\',\''.$r_c_name.'\')">delete</i>';
                    echo '</a>';
                    echo '</div>';
                    echo '</li>';
                }
            }
            $conn->close();
        ?>
    </ul>
</div>