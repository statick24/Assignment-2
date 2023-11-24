<?php 
namespace Controller;
/**
 * Authentication Interface
 *
 * This interface defines methods for user authentication within the MVP framework's controller module.
 */
interface InterfaceAuthentication {
    /**
     * Login
     *
     * Attempts to authenticate a user with the provided email and password.
     *
     * @param string $email The user's email address.
     * @param string $pwd The user's password.
     *
     * @return bool True if authentication is successful, false otherwise.
     */
   public function login(string $email, string $pwd):bool;
   /**
     * Logout
     *
     * Logs out the currently authenticated user.
     */
   public function logout();
   /**
     * Is Logged In
     *
     * Checks if a user is currently authenticated.
     *
     * @return bool True if a user is authenticated, false otherwise.
     */
   public function isLoggedIn();
   /**
     * Set User Model
     *
     * Sets the user model for the authentication process.
     *
     * @param \Model\UserModel $user The user model to be used for authentication.
     */
   public function setUserModel(\Model\UserModel $user);
}
