<?php

namespace Controller;
use \Model\ORM;

class WebAPI extends AbstractWebApi
{
    public function generateToken()
    {
        $orm = new ORM(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $orm->setTable("users");

        $key = '400004940';
        $records = $orm->read('users', 'id', '1');
        $data = "";
        foreach ($records as $rec) {
            $data = $rec['id'] . $rec['username'] . $rec['password'] . $rec['email'] . $rec['role'];
        }


        $token = hash_hmac('sha256', $data, $key);

        return $token;
    }

}
