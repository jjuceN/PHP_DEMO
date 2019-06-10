<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/6/10
 * Time: 17:06
 */

//获取公钥信息
$publicKeyPath = dirname(__FILE__).'/pem/rsa_public_key.pem';
$privateKeyPath = dirname(__FILE__).'/pem/rsa_private_key.pem';

//判断加密文件是否存在

if(!file_exists($publicKeyPath) || !file_exists($privateKeyPath)){
    echo '密钥文件不存在'.PHP_EOL;

}

//获取密钥里面的信息
$publicKey = file_get_contents($publicKeyPath);
$privateKey = file_get_contents($privateKeyPath);



//原始数据
$data = [
    'name' => 'Bob',
    'phone' => '12345678901'
];

//加密操作
$newData = [];

foreach ($data as $key => $value){
    $tmp = '';
    if(openssl_private_encrypt($value,$tmp,$privateKey)){
        $newData[$key] = $tmp;
    }else{
        echo '加密失败！！！！';
    }
}

//加密后的数据为
var_dump($newData);

//解密操作

foreach ($newData as $key => $value){
    $tmp = '';
    if(openssl_public_decrypt($value,$tmp,$publicKey)){
        $newData[$key] = $tmp;
    }else{
        echo '解密失败！！！！';
    }
}
var_dump($newData);