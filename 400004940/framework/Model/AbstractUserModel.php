<?php
namespace Model;
/**
 * Abstract User Model Class
 *
 * This abstract class provides a partial implementation of the UserModelInterface
 * for managing user-related information within the MVP framework's model module.
 */
abstract class AbstractUserModel implements InterfaceUserModel
{
    /**
     * @var mixed The unique identifier of the user.
     */
    protected $id;
    /**
     * @var string The username of the user.
     */
    protected $username;
    /**
     * @var string The password of the user.
     */
    protected $password;
    /**
     * @var string The email address of the user.
     */
    protected $email;

    /**
     * This function returns the data stored in user object as an array
     */
    abstract public function getUserAsArray();
    /**
     * This function sets the user data using an array
     */
    abstract public function setUserAsArray($user);

    public function getID()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setID($id)
    {
        $this->id = $id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPasswordHash($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
}
