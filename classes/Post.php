<?php
include_once "Content.php";

/**
 * Class to represent Posts
 * Class Post
 */
class Post extends Content
{
    /**
     * Title of the post
     * @var string
     */
    private $title;

    /**
     * Post constructor.
     * @param $author string
     * @param $content string
     * @param $title string
     * @throws Exception
     */
    public function __construct($author, $content, $title)
    {
        parent::__construct($author, $content);
        $this->title = $title;
    }

    /**
     * Gets the title of the post
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Creates an url from the title and the
     * @see Content::getFormattedDate()
     * used through out the source code as an id.
     * @return string|string[]|null
     */
    public function createUrlFromPost(){
        return preg_replace('/\s/u', '-', $this->getTitle() . " " . $this->getFormattedDate());
    }

    /**
     * Get all posts from posts.txt
     * @return array|Post[]
     */
    public static function getPosts() {
        $posts = unserialize(file_get_contents("posts.txt"));
        if(empty($posts)){
            $posts = [];
        }
        return $posts;
    }

    /**
     * Saves a post to posts.txt
     * @param $post Post, post to save
     */
    public static function savePost($post) {
        $post_text = file_get_contents("posts.txt");
        $posts = unserialize($post_text);
        if(empty($posts)){
            $posts = [];
        }
        array_push($posts, $post);
        file_put_contents("posts.txt", serialize($posts));
    }

    /**
     * Loads a post from posts.txt by id
     * @param $id, posts id, @see Post::createUrlFromPost()
     * @return Post|null, the post if it can be found, or null of the id does not match any post's id.
     */
    public static function loadPost($id){
        $posts = unserialize(file_get_contents("posts.txt"));
        if(empty($posts)){
            $posts = [];
        }
        foreach ($posts as $post){
            if($post->createUrlFromPost() === $id){
                return $post;
            }
        }
        return null;
    }

    /**
     * Replace the old post by id, with a new one
     * @param $updatedPost Post, the new post, with the same id as the old one.
     */
    public static function updatePost($updatedPost) {
        $posts = unserialize(file_get_contents("posts.txt"));
        if(!empty($posts)) {
            $i = 0;
            foreach ($posts as $post) {
                $i++;
                if ($post->createUrlFromPost() === $updatedPost->createUrlFromPost()) {
                    break;
                }
            }
            echo "<br/>";
            $posts[$i] = $updatedPost;
            file_put_contents("posts.txt", serialize($posts));
        } else {
            exit;
        }
    }

    /**
     * Loads a post by the url's id.
     * @return Post|null, The post if it can be found or null if it cannot be found.
     */
    public static function checkAndLoadPost() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            header("Location: index.php");
            exit;
        }

        $post = Post::loadPost($id);

        if ($post == null) {
            header("Location: index.php");
            exit;
        }
        return $post;
    }
}