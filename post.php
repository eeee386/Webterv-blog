<?php
    include_once "utils/InputUtils.php";
    include_once "classes/Post.php";
    include_once "classes/User.php";
    include_once "classes/Comment.php";
    include_once "common.php";
    upperPart();
    $post = Post::checkAndLoadPost();

    echo "<div class='post'>";
    echo "<h3 class='postTitle'>". $post->getTitle() ."</h3>";
    echo "<p class='postContent'>". $post->getContent() ."</p>";
    echo "<div>". $post->getAuthor() . ", " . $post->getFormattedDate() . "</div>";
    echo "</div>";
?>
<?php
    echo "<div class='commentSection'>";
    if(isset($_SESSION["user"])){
        echo "<form action='comment.php?id=" . $post->createUrlFromPost() . "' method='POST' class='newCommentForm'>
        <div>Write comment: </div>
        <textarea name='content'></textarea><br/>
        <input type='submit' name='newComment' value='Add new comment' />
        <br/>
        </form><br/>";
    } else {
        echo "<div>You have to login to comment: <a href='loginsignuplogout.php'>Click here to login/signup</a></div>";
    }
?>
<?php
    foreach (Comment::getCommentsByPostId($post->createUrlFromPost()) as $comment) {
        echo "<div class='comment'>";
        echo "<p>". $comment->getContent() ."</p>";
        echo "<div>". $comment->getAuthor() . ", " . $comment->getFormattedDate() . "</div>";
        echo "</div>";
    }
    echo "</div>";
?>
<?php
    lowerPart();
?>

