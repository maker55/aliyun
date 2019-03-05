<?php
namespace Aliyun;

use Aliyun\Core\Regions\EndpointConfig;
use Aliyun\OSS\OssClient;
use Aliyun\Vod\VodClient;

class AliyunManager
{
    public static $providers = [
        'vod' => VodClient::class,
        'oss' => OssClient::class
    ];
	
    public function __construct()
    {
        EndpointConfig::init();
    }

    public function provider($provider, $config)
    {
        return new self::$providers[$provider]($config);
    }


}