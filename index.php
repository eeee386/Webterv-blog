<?php
include_once ("classes/Post.php");
include_once("common.php");
upperPart();
?>
<?php
    $posts = Post::getPosts();
    foreach ($posts as $post) { ?>
        <div class="postView">
            <img src="styles/files/computer-palms.webp" class="postImage" alt="post-image"/>
            <h3 class='postTitle'><a href='post.php?id=<?php echo $post->createUrlFromPost() ?>'><?php echo $post->getTitle() . "</a></h3>";
        echo "<div class='postContent'>" . $post->getContent() . "</div>";
        echo "<div class='postFooter'>" . $post->getAuthor() . ", " . $post->getDateCreated()->format('Y-m-d H:i:s') . "</div></div>";
    }
?>
<?php
    lowerPart();
?>

