<?php
namespace Controller;
use \Model\ORM;
/**
 * Authentication Class
 *
 * This class extends the AbstractAuthentication class, providing a concrete
 * implementation of user authentication within the MVP framework's controller module.
 */
class Authentication extends AbstractAuthentication
{

    
    public function login(string $email, string $pwd): bool
    {
        $orm = new ORM(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $data = $orm->read('users', "email", $email);
        foreach ($data as $index => $rec) {
            $this->user->setPassword($rec["password"]);
            // Check password against hash
            if ($this->user->verifyPassword($pwd)) {
                $role_name = $orm->read('roles', 'id', $rec["role"]);
                $this->session->set('user',$rec["username"]);
                $this->session->set('email', $rec["email"]);
                $this->session->set('role_id', $rec["role"]);
                $this->session->set('role_name', $role_name[0]['role']);
                return true;
            }
        } 
        return false;
    }

    public function isLoggedIn(): bool
    {
        //check to see if $_SESSION['user'] is set
        if ($this->session->has('user')) {
            return true;
        }
        return false;
    }
}
