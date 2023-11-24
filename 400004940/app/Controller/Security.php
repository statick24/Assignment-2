<?php 
namespace Controller;
/**
 * Security Class
 *
 * This class extends the AbstractSecurity class and provides
 * specific implementations for the abstract methods.
 */
class Security extends AbstractSecurity {
    public static function bindParameters(mixed $stmt, array|string $params, array $types){
        if (is_array($params)) {
            foreach ($params as &$param) {
                $types[] = &$param;
            }
        } else {
            $types[] = &$params;
        }
        call_user_func_array(array($stmt, 'bind_param'), $types);
    }

}
?>