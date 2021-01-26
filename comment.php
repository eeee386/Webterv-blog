<?php
include_once "utils/InputUtils.php";
include_once "classes/Post.php";
include_once "classes/Comment.php";
include_once "classes/User.php";
session_start();

$post = Post::checkAndLoadPost();

if(isset($_POST["newComment"])){
    $content = $_POST["content"];
    if(empty($content)){
        InputUtils::createInputError("Content is empty");
    } else {
        $user = $_SESSION["user"];
        try {
            $comment = new Comment($user->getUserName(), $content, $post->createUrlFromPost());
        } catch (Exception $e){
            InputUtils::createInputError($e);
        }
        Comment::saveComment($comment);
    }
    header("Location: post.php?id=" . $post->createUrlFromPost());
}