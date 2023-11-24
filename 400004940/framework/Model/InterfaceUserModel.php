<?php

namespace Model;

/**
 * User Model Interface
 *
 * This interface defines methods for managing user-related information within
 * the MVP framework's model module.
 */
interface InterfaceUserModel
{
    /**
     * Get User ID
     *
     * Retrieves the unique identifier of the user.
     *
     * @return mixed The user ID.
     */
    public function getID();
    /**
     * Get Username
     *
     * Retrieves the username of the user.
     *
     * @return string The username.
     */
    public function getUsername();
    /**
     * Get Password
     *
     * Retrieves the password of the user.
     *
     * @return string The password.
     */
    public function getPassword();
    /**
     * Get Email
     *
     * Retrieves the email address of the user.
     *
     * @return string The email address.
     */
    public function getEmail();
    /**
     * Get User as Array
     *
     * Retrieves the user information as an associative array.
     *
     * @return array The user information as an associative array.
     */
    public function getUserAsArray();
    /**
     * Set User ID
     *
     * Sets the unique identifier of the user.
     *
     * @param mixed $id The user ID.
     */
    public function setID($id);
    /**
     * Set Username
     *
     * Sets the username of the user.
     *
     * @param string $username The username.
     */
    public function setUsername($username);
    /**
     * Set Password
     *
     * Sets the password of the user without hashing.
     *
     * @param string $password The password.
     */
    public function setPassword($password);
    /**
     * Set Password Hash
     *
     * Hashes and  the password of the user.
     *
     * @param string $password The hashed password.
     */
    public function setPasswordHash($password);
    /**
     * Set Email
     *
     * Sets the email address of the user.
     *
     * @param string $email The email address.
     */
    public function setEmail($email);
    /**
     * Verify Password
     *
     * Verifies if the provided password matches the user's stored hashed password.
     *
     * @param string $password The password to verify.
     *
     * @return bool True if the password is verified, false otherwise.
     */
    public function verifyPassword($password);
    /**
     * Set User as Array
     *
     * Sets the user information using an associative array.
     *
     * @param array $user An associative array containing user information.
     */
    public function setUserAsArray($user);
}
