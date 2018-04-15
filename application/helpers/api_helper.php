<?php
/**
 * JSON输出接口回调内容
 * @param integer $code 响应状态码
 * @param string $message 响应消息
 * @param array $data 需返回的数据集合
 */
function makeApiData($code=0,$message='',$data=array()){
	$data=array(
		'code'=>$code,
		'message'=>$message,
		'data'=>$data,
		'requestId'=>date('YmdHis',time())
	);
	return json_encode($data);
}