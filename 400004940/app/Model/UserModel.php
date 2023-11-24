<?php

namespace Model;

/**
 * User Model Class
 *
 * This class extends the AbstractUserModel class, providing specific implementations
 * for managing user-related information, including the role, within the MVP framework's model module.
 */
class UserModel extends AbstractUserModel
{
    /**
     * @var int The role of the user.
     */
    protected $role;
    /**
     * Set User Role
     *
     * Sets the role of the user.
     *
     * @param int $role The user role.
     */
    public function setRole($role)
    {
        $this->role =  intval($role);
    }
    /**
     * Get User Role
     *
     * Retrieves the role of the user.
     *
     * @return int The user role.
     */
    public function getRole()
    {
        return $this->role;
    }

    public function setUserAsArray($user)
    {
        $this->setUsername($user['username']);
        $this->setEmail($user['email']);
        $this->setPasswordHash($user['password']);
        $this->setRole($user['AccessLevel']);
    }
    public function getUserAsArray()
    {
        $user = [];
        $user["username"] = $this->getUsername();
        $user["email"] = $this->getEmail();
        $user["password"] = $this->getPassword();
        $user["role"] = $this->getRole();
        return $user;
    }
}
