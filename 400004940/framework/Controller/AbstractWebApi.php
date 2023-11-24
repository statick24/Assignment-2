<?php

namespace Controller;



abstract class AbstractWebApi implements InterfaceWebAPI
{
    /**
     * @var string $token The token generated using generateToken
     */
    protected $token;

    public function __construct()
    {
        $this->token = $this->generateToken();
    }


    public function verifyToken($token)
    {

        if ($token == $this->token) {
            return true;
        } else {
            return false;
        }
    }

    abstract public function generateToken();
}
