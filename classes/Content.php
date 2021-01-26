<?php


/**
 * Class to represent Content such as Post or Comment
 * Class Content
 * For implementations of the Content Class:
 * @see Post
 * @see Comment
 */
abstract class Content
{
    /**
     * Author of content
     * @var string
     */
    private $author;

    /**
     * Content of the Content
     * @var string
     */
    private $content;

    /**
     * Content's time of creation
     * @var DateTime
     */
    private $date_created;

    /**
     * Content constructor.
     * @param $author : string
     * @param $content : string
     * @throws Exception
     */
    public function __construct($author, $content)
    {
        $this->author = $author;
        $this->content = $content;
        $this->date_created = new DateTime();
    }

    /**
     * Get Author of Content
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * get Content's content
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the time of the content's creation
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Get an easy to read format of the Content's time of creation in seconds
     * @return string
     */
    public function getFormattedDate() {
        return $this->getDateCreated()->format('Y-m-d H:i:s');
    }

    /**
     * Get an easy to read format of the Content's time of creation in days
     * @return string
     */
    public function getFormattedDateToDay() {
        return $this->getDateCreated()->format('Y-m-d');
    }

}