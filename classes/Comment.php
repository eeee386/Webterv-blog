<?php
include_once "Content.php";

/**
 * Class represent Comments
 * Class Comment
 */
class Comment extends Content
{
    /**
     * The id of the Post, which this comment is a part of.
     * @var string
     * @see Post::createUrlFromPost() where this id is coming from
     */
    private $post_id;
    /**
     * Comment constructor.
     * @param $author string
     * @param $content string
     * @param $post_id string
     * @throws Exception
     */
    public function __construct($author, $content, $post_id)
    {
        parent::__construct($author, $content);
        $this->post_id = $post_id;
    }

    /**
     * The id of the Post, which this comment is a part of.
     * @return string, post's id
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * Gets all the comments from the comments.txt and filters them by the given post's $id
     * @param $id string, id of the Post
     * @return Comment[], Comments filtered by the $id
     */
    public static function getCommentsByPostId($id) {
        $comments = unserialize(file_get_contents("comments.txt"));
        if(empty($comments)){
            $comments = [];
        }
        $filtered_comments = [];
        foreach ($comments as $comment){
            if($comment->getPostId() === $id){
                array_push($filtered_comments, $comment);
            }
        }
        return $filtered_comments;
    }

    /**
     * Save's a new comment into the comments.txt file.
     * @param $comment Comment, comment to be saved
     */
    public static function saveComment($comment) {
        $comment_text = file_get_contents("comments.txt");
        $comments = unserialize($comment_text);
        if(empty($comments)){
            $comments = [];
        }
        array_push($comments, $comment);
        file_put_contents("comments.txt", serialize($comments));
    }

}