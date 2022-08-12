<?php

include "model/dataBase.php";
include "controller/functions.php";
$posts=$db->query("SELECT *,posts.id AS post_id,users.id AS user_id  FROM posts inner join users ON posts.user_id=users.id ORDER BY post_id DESC");

$userId=$_SESSION["userID"];
$user=$db->query("SELECT * FROM users WHERE id=$userId")->fetch_assoc();


$postArray=array();

foreach ($posts as $post):

    $postId=$post["post_id"];
    $post["comments"] = $db->query("SELECT * FROM comments INNER JOIN users ON comments.user_id=users.id WHERE post_id=$postId");

    $post["likes"]=$db->query("SELECT COUNT(*) AS counter FROM likes WHERE post_id=$postId")->fetch_assoc();


    $postArray[]=$post;

    endforeach;




if($_SESSION["login_admin_status"]==true){
    require "view/explore.php";
}else{
    require "view/index.php";
}

?>