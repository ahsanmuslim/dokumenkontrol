<?php
namespace Teckindo\DokumenKontrol\Config;

function Conn()
{
    return $db =  [
        "host" => $_ENV['DB_HOST'],
        "port" => $_ENV['DB_PORT'],
        "user" => $_ENV['DB_USERNAME'],
        "pass" => $_ENV['DB_PASSWORD'],
        "name" => $_ENV['DB_DATABASE']
    ];
}

//DB Firman LOcalhost
function Conn2()
{
    return $db =  [
        "host" => "127.0.0.1",
        "port" => "3306",
        "user" => "root",
        "pass" => "",
        "name" => "firman_indonesia"
    ];
}

// function Conn2()
// {
//     return $db =  [
//         "host" => "116.206.197.0",
//         "port" => "4406",
//         "user" => "FirmanWepApp",
//         "pass" => "b69e73be5383434001ef6458689d152842849935b863b4b7de7364fcd50675d3",
//         "name" => "firman_indonesia"
//     ];
// }


function App()
{
    return $app = [
        "app_name" => $_ENV['APP_NAME'],
        "app_env" => $_ENV['APP_ENV'],
        "app_url" => $_ENV['APP_URL'],
        "lifetime" => $_ENV['SESSION_LIFETIME'],
        "api_mac" => $_ENV['API_KEY_MAC'],
        "api_tiny" => $_ENV['API_KEY_TINY'],
        "api_key_firman" => $_ENV['API_KEY_FIRMAN'],
        "api_url_firman" => $_ENV['API_URL_FIRMAN']
    ];
}
