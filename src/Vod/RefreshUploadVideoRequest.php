<?php

namespace Aliyun\Vod;

use Aliyun\Core\RpcAcsRequest;

class RefreshUploadVideoRequest extends RpcAcsRequest
{
    function __construct()
    {
        parent::__construct("vod", "2017-03-21", "RefreshUploadVideo");
        $this->setMethod("POST");
    }

    private $resourceOwnerId;

    private $resourceOwnerAccount;

    private $videoId;

    private $ownerId;

    public function getResourceOwnerId()
    {
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters["ResourceOwnerId"] = $resourceOwnerId;
    }

    public function getResourceOwnerAccount()
    {
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters["ResourceOwnerAccount"] = $resourceOwnerAccount;
    }

    public function getVideoId()
    {
        return $this->videoId;
    }

    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
        $this->queryParameters["VideoId"] = $videoId;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
        $this->queryParameters["OwnerId"] = $ownerId;
    }

}