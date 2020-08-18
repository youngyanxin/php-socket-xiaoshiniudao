

<?php

/**
 * Created by PhpStorm.
 * User: yangyanxin
 * Date: 2020/8/18
 * Time: 下午5:26
 */


$port = '8999';

$ip = '127.0.0.1';

$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP );
if (!$socket) {
	return 'socket_create'.socket_strerror($socket);
}else {

	echo 'connect '.$ip.'prot:'.$port.'.....';
}
$result =  socket_connect($socket,$ip,$port);

#var_dump($result);die;

if (!$result) {
	echo 'socket_connect error'. socket_strerror($socket);
}else {
	echo 'connect success';

	//发送数据
	socket_write($socket,'感觉你像个煞笔！',1024);

	$result = socket_read($socket,1024);

	echo '服务器返回数据'.$result.'</br>';

	echo 'close socket'.'</br>';

	socket_close($socket);
}
