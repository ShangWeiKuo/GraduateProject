<?php include_once("part/sql-connection.php"); ?>
<div class="container index-content">
    <h3 class="center-align">核心通識</h3>
    <div class="row index-box">
        <?php
            $stmt = $conn->prepare('SELECT ct_id, ct_name_sec FROM class_type WHERE ct_name = "核心通識"');
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ct_id, $ct_name_sec);
            while(mysqli_stmt_fetch($stmt)){
                echo '<div class="col s12 m4">';
                echo '<span class="flow-text">';
                echo '<div class="row">';
                echo '<div class="card">';
                echo '<a href="./class-list.php?ct='.$ct_id.'">';
                echo '<div class="card-image hoverable">';
                echo '<img src="./source/img/ct'.$ct_id.'.jpg">';
                echo '<span class="card-title">'.$ct_name_sec.'</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</span>';
                echo '</div>';
            }
        ?>
    </div>
    <h3 class="center-align">博雅通識</h3>
    <div class="row index-box">
        <?php
            $stmt = $conn->prepare('SELECT ct_id, ct_name_sec FROM class_type WHERE ct_name = "博雅通識"');
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ct_id, $ct_name_sec);
            while(mysqli_stmt_fetch($stmt)){
                echo '<div class="col s12 m4">';
                echo '<span class="flow-text">';
                echo '<div class="row">';
                echo '<div class="card">';
                echo '<a href="./class-list.php?ct='.$ct_id.'">';
                echo '<div class="card-image hoverable">';
                echo '<img src="./source/img/ct'.$ct_id.'.jpg">';
                echo '<span class="card-title">'.$ct_name_sec.'</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</span>';
                echo '</div>';
            }
        ?>
    </div>
    <h3 class="center-align">共同必修</h3>
    <div class="row index-box">
        <?php
            $stmt = $conn->prepare('SELECT ct_id, ct_name_sec FROM class_type WHERE ct_name = "共同必修"');
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ct_id, $ct_name_sec);
            while(mysqli_stmt_fetch($stmt)){
                echo '<div class="col s12 m4">';
                echo '<span class="flow-text">';
                echo '<div class="row">';
                echo '<div class="card">';
                echo '<a href="./class-list.php?ct='.$ct_id.'">';
                echo '<div class="card-image hoverable">';
                echo '<img src="./source/img/ct'.$ct_id.'.jpg">';
                echo '<span class="card-title">'.$ct_name_sec.'</span>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</span>';
                echo '</div>';
            }
        ?>
    </div>
</div>