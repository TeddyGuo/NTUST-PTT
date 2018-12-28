<?php
    include("util/connect.php");

    if ($_GET['confirm'] != 'true')
        exit("Illegal call to this page.");

    $con->query("DROP VIEW top_cache") or die($query . '<br/>' . $con->error);
    $con->query("DROP TABLE post") or die($query . '<br/>' . $con->error);
    $con->query("DROP TABLE post_reply") or die($query . '<br/>' . $con->error);
    $con->query("DROP TABLE rule") or die($query . '<br/>' . $con->error);
    $con->query("DROP TABLE board") or die($query . '<br/>' . $con->error);
    $con->query("DROP TABLE user") or die($query . '<br/>' . $con->error);

    $con->query("CREATE TABLE user (
        user_id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(20) NOT NULL,
        password VARCHAR(32) NOT NULL,
        default_permission INT NOT NULL,
        registration_time DATETIME NOT NULL,

        UNIQUE(username),
        PRIMARY KEY (user_id),
        UNIQUE INDEX (username, password)
    )") or die($query . '<br/>' . $con->error);

    $con->query("CREATE TABLE board (
        board_id INT NOT NULL AUTO_INCREMENT,
        board_name VARCHAR(50) NOT NULL,

        UNIQUE(board_name),
        PRIMARY KEY (board_id)
    )") or die($query . '<br/>' . $con->error);

    $con->query("CREATE TABLE rule (
        user_id INT NOT NULL,
        board_id INT NOT NULL,
        permission INT NOT NULL,

        PRIMARY KEY (user_id, board_id),
        FOREIGN KEY (user_id) REFERENCES user(user_id),
        FOREIGN KEY (board_id) REFERENCES board(board_id)
    )") or die($query . '<br/>' . $con->error);

    $con->query("CREATE TABLE post (
        post_id INT NOT NULL AUTO_INCREMENT, 
        user_id INT NOT NULL,
        board_id INT NOT NULL,
        post_name VARCHAR(50),
        create_time DATETIME NOT NULL,
        last_update DATETIME NOT NULL,
        content TEXT NOT NULL,
        img TEXT NULL,

        PRIMARY KEY (post_id),
        FOREIGN KEY (user_id) REFERENCES user(user_id),
        FOREIGN KEY (board_id) REFERENCES board(board_id)
    )") or die($query . '<br/>' . $con->error);

    $con->query("CREATE TABLE post_reply (
        reply_id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        post_id INT NOT NULL,
        create_time DATETIME NOT NULL,
        content TEXT NOT NULL,
        img TEXT NULL,

        PRIMARY KEY (reply_id),
        FOREIGN KEY (post_id) REFERENCES post(post_id)
    )") or die($query . '<br/>' . $con->error);

    $con->query("CREATE VIEW top_cache
    (
        post_id, reply_count
    ) AS SELECT post_id, count(*) FROM post_reply GROUP BY post_id LIMIT 10") or die($query . '<br/>' . $con->error);
?>

<!DOCTYPE html>
<script>
    alert("Database has been reset.");
</script>