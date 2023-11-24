<?php

namespace Controller;
/**
 * Session Interface
 *
 * This interface defines methods for managing sessions within the MVP framework's controller module.
 */
interface InterfaceSession
{
   /**
     * Start Session
     *
     * Initiates the session and makes session variables available.
     */
   public function start();
   /**
     * Stop Session
     *
     * Ends the current session and releases session resources.
     */
   public function stop();
    /**
     * Set Session Value
     *
     * Sets a value in the session identified by the given key.
     *
     * @param string $key   The key for the session value.
     * @param mixed  $value The value to be stored in the session.
     */
   public function set($key, $value);
   /**
     * Get Session Value
     *
     * Retrieves the value from the session associated with the given key.
     *
     * @param string $key The key for the session value.
     *
     * @return mixed|null The value associated with the key, or null if the key is not set.
     */
   public function get($key);
   /**
     * Check if Session Value Exists
     *
     * Checks if a session value exists for the given key.
     *
     * @param string $key The key for the session value.
     *
     * @return bool True if the key exists in the session, false otherwise.
     */
   public function has($key);
   /**
     * Remove Session Value
     *
     * Removes the session value associated with the given key.
     *
     * @param string $key The key for the session value to be removed.
     */
   public function remove($key);
   /**
     * Generate Session Token
     *
     * Generates a unique session token.
     *
     * @return string The generated session token.
     */
   public function generateToken();
   /**
     * Refresh Session Token
     *
     * Regenerates the session token, providing a new unique identifier. Stored in Session variable token
     */
   public function refreshToken();
   /**
     * Check Session Timeout
     *
     * Checks if the session has timed out based on a predetermined timeout period.
     *
     * @return bool True if the session has timed out, false otherwise.
     */
   public function checkTimeout();
}
