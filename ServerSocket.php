<?php
/**
 * Created by PhpStorm.
 * User: h
 * Date: 2020/8/18
 * Time: 15:17
 */

namespace socket;

use socket\Config;

/**
 * 服务端
 * Class socket
 * @package socket
 */
class socket
{
    protected $ip = null;

    protected $port = null;


    public function __construct() {

        $this->ip = Config::HOST_IP;
        $this->port = Config::HOST_PORT;

    }


	/**
	 * 连接socket
	 * author yangyanxin
	 * Date: 2020/8/18
	 * updateDate: 2020年08月18日16:44:34
	 * @return string
	 */
    public function connect()
    {
    	date_default_timezone_set('Asia/Shanghai');

    	error_reporting(E_NOTICE);

        $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP );
        if (!$socket) {
			return 'socket_create'.socket_strerror($socket);
        }
        #var_dump($this->ip,$this->port);
		
        $bind = socket_bind($socket,$this->ip,$this->port);
        #var_dump($bind);die;
        if (!$bind) {
            return 'socket_bind'.socket_strerror($socket);
        }
		#var_dump($bind);die;
        $listen = socket_listen($socket,6);
        if (!$listen) {
			return 'socket_listen'.socket_strerror($socket);
        }

        #var_dump($listen);die;
        do {
			if (($msgSocket = socket_accept($socket)) < 0 ) {
				return 'socket_accept'.socket_strerror($msgSocket).'\n';
				break;
			}else {
				$i = (int) $msgSocket;
				$readClient = socket_read($msgSocket,1024);

				#echo $readClient;
				echo "welcome to client" . $i. ' ' . $readClient.'\n';

				//效应数据
				$msg = '连接成功';
				socket_write($msgSocket,$msg,strlen($msg));

 			}
			socket_close($msgSocket);
		}while(true);
        socket_close($socket);

    }


}

(new socket())->connect();

#(new socket())->listen();
