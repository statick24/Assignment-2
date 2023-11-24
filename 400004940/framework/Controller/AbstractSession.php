<?php
namespace Controller;
/**
 * Abstract Session Class
 *
 * This abstract class provides a basic implementation of the SessionInterface
 * for managing sessions within the MVP framework's controller module.
 */
class AbstractSession implements InterfaceSession
{

    function __construct()
    {
        $this->start();
    }
    public function start()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!$this->has('token')){
            $this->refreshToken();
        }
        $this->refreshToken();
        if (!$this->checkTimeout()) {
            $this->set('last_activity', time());
        }
    }
    public function stop()
    {
        session_unset();
        session_destroy();
    }
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
    public function generateToken(){
        return md5(uniqid(mt_rand(), true));
    }
    public function refreshToken(){
        $this->set('token', $this->generateToken());
    }

    public function checkTimeout(){
        if ($this->has('last_activity') && (time() - $this->get('last_activity') > SESSION_MAX_LIFETIME)){
            return true;
        }
        return false;
    }
}
