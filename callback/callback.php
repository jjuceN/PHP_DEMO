<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/6/10
 * Time: 18:12
 */


//闭包的三种写法


//在函数里定义一个匿名函数，并且调用它

function saySomeThing($word){

    $tmpFun = function ($word){
        echo $word.PHP_EOL;
    };

    $tmpFun($word);

}

saySomeThing('你好,世界！');

//在函数里面定义一个匿名函数，作为返回值返回，并调用它

function returnMethod(){
    $tmpFun = function ($params){
        var_dump($params);
    };

    return $tmpFun;
}

$tmpFun = returnMethod();
$tmpFun(['name' => 'zhangsan']);


//把匿名函数当成参数，并调用它
function argumentMethod(callable $fun){
    $fun(['name' => '张三']);
}

$fun = function($arg){
    print_r($arg);
};

argumentMethod($fun);


//连接闭包和外界变量的关键字：USEa,这里用闭包的第一种写法作为案例
function useMethod(){

    $string = 'mia';
    $int = 9527;

    //内部定义一个匿名函数
    $fun = function ($arg) use($string,&$int){
        echo "匿名函数的参数是:".$arg.PHP_EOL;
        echo "引用的参数是:".$string.';'.$int.';'.PHP_EOL;
        $int++;
    };

    $fun('I am tree');
    var_dump($int);

}
useMethod();

$string = 'mia';
$int = 9527;
//连接闭包和外界变量的关键字：USEa,这里用闭包的第三种写法作为案例
function useMethodReq( callable $fun){

    //内部定义一个匿名函数
    $fun('I am tree');
    $fun('I am tree');
    $fun('I am tree');


}

useMethodReq(function ($arg) use($string,&$int){
    echo "匿名函数的参数是:".$arg.PHP_EOL;
    echo "引用的参数是:".$string.';'.$int.';'.PHP_EOL;
    var_dump($int);
    $int++;
});

