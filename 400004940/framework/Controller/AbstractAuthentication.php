<?php

namespace Controller;

/**
 * Abstract Authentication Class
 *
 * This abstract class provides a basic implementation of the InterfaceAuthentication
 * for user authentication within the MVP framework's controller module.
 */
abstract class AbstractAuthentication implements InterfaceAuthentication
{
    /**
     * UserModel Property
     *
     * @var \Model\UserModel $user The user model instance used for authentication and user-related operations.
     */
    
    protected \Model\UserModel $user;
    /**
     * Session Property
     *
     * @var InterfaceSession $session The session object used for managing user sessions.
     */
    protected InterfaceSession $session;

    /**
     * Constructor for AbstractAuthentication Class
     *
     * This constructor initializes the Authentication class and sets up the session object.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    public function setUserModel(\Model\UserModel $user)
    {
        $this->user = $user;
    }

    public function logout()
    {
        //remove user session
        $this->session->stop();
        return true;
    }
    abstract public function isLoggedIn();
}
