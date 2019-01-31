<?php
namespace Aliyun\Core\Regions;

use Aliyun\Core\Http\HttpHelper;
use Aliyun\Core\RpcAcsRequest;



class DescribeEndpointRequest extends RpcAcsRequest
{
    const LOCATION_SERVICE_PRODUCT_NAME='Location';
    const LOCATION_SERVICE_VERSION='2015-06-12';
    const LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION='DescribeEndpoints';
    const LOCATION_SERVICE_REGION='cn-hangzhou';
    function __construct($id, $serviceCode, $endPointType)
    {
        parent::__construct(LOCATION_SERVICE_PRODUCT_NAME, LOCATION_SERVICE_VERSION, LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION);

        $this->queryParameters["Id"] = $id;
        $this->queryParameters["ServiceCode"] = $serviceCode;
        $this->queryParameters["Type"] = $endPointType;
        $this->setRegionId(LOCATION_SERVICE_REGION);

        $this->setAcceptFormat("JSON");
    }
}

class LocationService
{
    private $clientProfile;
    public static $cache = array();
    public static $lastClearTimePerProduct = array();
    public static $serviceDomain = "location.aliyuncs.com";

    function __construct($clientProfile)
    {
        $this->clientProfile = $clientProfile;
    }

    public function findProductDomain($regionId, $serviceCode, $endPointType, $product)
    {
        $key = $regionId . '#' . $product;

        @$domain = self::$cache[$key];
        if ($domain == null || $this->checkCacheIsExpire($key) == true) {
            $domain = $this->findProductDomainFromLocationService($regionId, $serviceCode, $endPointType);
            self::$cache[$key] = $domain;
        }

        return $domain;
    }

    public static function addEndPoint($regionId, $product, $domain)
    {
        $key = $regionId . '#' . $product;
        self::$cache[$key] = $domain;
        $lastClearTime = mktime(0, 0, 0, 1, 1, 2999);
        self::$lastClearTimePerProduct[$key] = $lastClearTime;
    }

    public static function modifyServiceDomain($domain)
    {
        self::$serviceDomain = $domain;
    }

    private function checkCacheIsExpire($key)
    {
        $lastClearTime = self::$lastClearTimePerProduct[$key];
        if ($lastClearTime == null) {
            $lastClearTime = time();
            self::$lastClearTimePerProduct[$key] = $lastClearTime;
        }

        $now = time();
        $elapsedTime = $now - $lastClearTime;

        if ($elapsedTime > 3600) {
            $lastClearTime = time();
            self::$lastClearTimePerProduct[$key] = $lastClearTime;
            return true;
        }

        return false;
    }

    private function findProductDomainFromLocationService($regionId, $serviceCode, $endPointType)
    {
        $request = new DescribeEndpointRequest($regionId, $serviceCode, $endPointType);

        $signer = $this->clientProfile->getSigner();
        $credential = $this->clientProfile->getCredential();

        $requestUrl = $request->composeUrl($signer, $credential, self::$serviceDomain);

        $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), null, $request->getHeaders());

        if (!$httpResponse->isSuccess()) {
            return null;
        }

        $respObj = json_decode($httpResponse->getBody());
        return $respObj->Endpoints->Endpoint[0]->Endpoint;
    }
}