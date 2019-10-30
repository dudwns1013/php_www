<?php

$config = include "../dbconf.php";
// echo "대림대학교";
// print_r($config);

require "../Loading.php";
/*
require "../Module/Database/database.php";
require "../Module/Database/table.php";
*/

//$desc = new \App\Controller\TableInfo;
//$desc->main();

$uri = $_SERVER['REQUEST_URI'];
$uris = explode("/",$uri); // 파란책
// print_r($uris);

$db = new \Module\Database\Database($config);

if(isset($uris[1]) && $uris[1]){
    // 컨트롤러 실행...
    // echo $uris[1]."컨트롤러 실행...";
    $controllerName = "\App\controller\\".ucfirst($uris[1]);
    $tables = new $controllerName($db);
    $tables->main();

}else{
    // 처음 페이지 에요..
    //echo "처음 페이지 에요.";
    $body = file_get_contents("../Resource/index.html");
    echo $body;
}