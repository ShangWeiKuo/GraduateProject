<?php
    $stmt = $conn->prepare('DELETE FROM token WHERE expired <= ?');
    $stmt->bind_param('d', time());
    mysqli_stmt_execute($stmt);
    $stmt->close();
    $token = md5(uniqid(rand()));
    $stmt = $conn->prepare('INSERT INTO token (expired, token) VALUES (?, ?)');
    $expired = time() + 86400;
    $stmt->bind_param('ds', $expired, $token);
    mysqli_stmt_execute($stmt);
    $stmt->close();
?>