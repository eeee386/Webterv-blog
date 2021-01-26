<?php

/**
 * Class to represent the User of the application
 * Class User
 */
class User
{
    /**
     * Username of the user.
     * @var string
     */
    private $username;

    /**
     * Password of the user
     * @var string
     */
    private $password;

    /**
     * User's opinion about the page's look.
     * @var string|null
     */
    private $isAesthetic;

    /**
     * operating systems of the user
     * @var string[]
     */
    private $operating_system;

    /**
     * User constructor.
     * @param string $username
     * @param string $password
     * @param string|null $isAesthetic
     * @param string[] $operating_system
     */
    public function __construct($username, $password, $isAesthetic, $operating_system)
    {
        $this->username = $username;
        $this->password = $password;
        $this->isAesthetic = $isAesthetic;
        $this->operating_system = $operating_system;
    }


    /**
     * Gets the user's username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the user's password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Gets the value of isAesthetic
     * @return string|null
     */
    public function getIsAesthetic()
    {
        return $this->isAesthetic;
    }

    /**
     * Gets the value of the user's operating systems
     * @return string[]
     */
    public function getOperatingSystem()
    {
        return $this->operating_system;
    }


    /**
     * Gets the users from the users.txt
     * @return array|User[]
     */
    public static function getUsers() {
        $accounts = unserialize(file_get_contents("accounts.txt"));
        if(empty($accounts)){
            $accounts = [];
        }
        return $accounts;
    }

    /**
     * Saves a new user to users.txt
     * @param $accounts User[], the already saved users
     * @param $user User, the user to be saved
     */
    public static function saveUser($accounts, $user){
        $accounts[$user->getUsername()] = $user;
        file_put_contents("accounts.txt", serialize($accounts));
    }

}