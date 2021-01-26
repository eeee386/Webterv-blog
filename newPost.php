<?php
include_once "classes/Post.php";
include_once "utils/InputUtils.php";
include_once "classes/User.php";
include_once "common.php";
upperPart();
?>
<?php
    if(isset($_SESSION["user"])){
        echo "<form action='newPost.php' method='POST' class='newPostForm'>
            <label>Title: <input type='text' name='title'/></label> <br/>
            <label>Content: <textarea name='content'></textarea></label> <br/>
            <input type='submit' name='newPost' value='Add new post' /><br/>
            </form>";
    } else {
        header('location: loginsignuplogout.php');
    }

?>
<?php
    if(isset($_POST["newPost"])){
        $title = $_POST["title"];
        $content = $_POST["content"];
        if(empty($title)){
            InputUtils::createInputError("Title is empty");
        } else if(empty($content)){
            InputUtils::createInputError("Content is empty");
        } else {
            $user = $_SESSION["user"];
            try {
                $post = new Post($user->getUserName(), $content, $title);
            } catch (Exception $e){
                InputUtils::createInputError($e);
            }
            Post::savePost($post);
            header('location: index.php');
        }

    }
?>
<?php
lowerPart();