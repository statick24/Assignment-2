<?php

namespace Controller;

/**
 * Abstract Security Class
 *
 * This abstract class provides a basic implementation of the Security Interface
 * for handling security-related tasks within the MVP framework's controller module.
 */
abstract class AbstractSecurity implements InterfaceSecurity
{
    public static function prepareStatement($con, $sql, $params, $types = "")
    {

        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            trigger_error("Error preparing statement", E_USER_ERROR);
        }

        if ($stmt) {

            if (!empty($params)) {
                // Check if types empty, if so default to string
                if (empty($types)) {
                    $types = str_repeat('s', count($params));
                }
                $bindParams = array(&$types);
                try {
                    Security::bindParameters($stmt, $params, $bindParams);
                } catch (\Error $e) {
                    trigger_error($e->getMessage(), E_USER_WARNING);
                }
            }
        }
        return $stmt;
    }
    abstract public static function bindParameters(mixed $stmt, array|string $params, array $types);
}
