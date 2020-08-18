<?php
/**
 * Created by PhpStorm.
 * User: h
 * Date: 2020/8/18
 * Time: 15:17
 */

namespace socket;


/**
 * 服务端
 * Class socket
 * @package socket
 */
class socket
{
    protected $ip = null;

    protected $port = '80';

    public function __construct() {

        $this->ip = '127.0.0.1';
        $this->port = '8088';

    }


    public function connect()
    {
        $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP );
        if (!$socket) {
            return 'socket_create'.socket_strerror($socket);
        }
        $bind = socket_bind($socket , $this->ip , $this->port );
        if (!$bind) {
            echo 'socket_bind'.socket_strerror($socket);
        }

        $listen = socket_listen($socket,6);
        if (!$listen) {
            echo 'socket_listen'.socket_strerror($socket);
        }
        $msgSocket = socket_accept($socket);
        var_dump($msgSocket);
        #return $socket;
    }




}


(new socket())->connect();

#(new socket())->listen();
