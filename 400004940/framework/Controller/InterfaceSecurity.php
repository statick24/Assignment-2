<?php 
namespace Controller;
/**
 * Security Interface
 *
 * This interface defines security-related methods within the MVP framework's controller module.
 */
interface InterfaceSecurity {
     /**
     * Prepare Statement
     *
     * Prepares a SQL statement for execution with optional parameter binding.
     *
     * @param mixed  $con      The database connection object.
     * @param string $sql      The SQL query string.
     * @param array  $params   An associative array of parameters to bind to the statement.
     * @param string $types    (Optional) A string representing the data types of the parameters.
     *
     * @return mixed A prepared statement object.
     */
    public static function prepareStatement($con, $sql, $params, $types = "");
    /**
     * Bind Parameters
     *
     * Binds parameters to a prepared statement based on provided types.
     *
     * @param mixed  $stmt   The prepared statement object.
     * @param array|string  $params An associative array of parameters to bind to the statement.
     * @param array $types  A string representing the data types of the parameters.
     */
    public static function bindParameters(mixed $stmt, array|string $params, array $types);

}
?>