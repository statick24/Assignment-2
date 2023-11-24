<?php 
namespace Controller;
/**
 * Web API Interface
 *
 * This interface defines methods for handling web API-related operations
 * within the MVP framework's controller module.
 */
interface InterfaceWebAPI {
    
    /**
     * Verify Token
     *
     * Checks if token matches generated token.
     *
     * @param string $token The token to be verified.
     *
     * @return bool True/False for success of verification
     */
    public function verifyToken($token);
    
    /**
     * Generate Token
     *
     * This method generates a new authentication token.
     * @return string returns generated token
     *
     */
    public function generateToken();
}
?>