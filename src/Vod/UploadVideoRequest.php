<?php

namespace Aliyun\Vod;

class UploadVideoRequest
{
    /**
     * UploadVideoRequest constructor.
     *
     * @param      $filePath
     * @param null $title
     * @throws Exception
     */
    public function __construct($filePath, $title = null)
    {
        $this->setFilePath($filePath, $title);
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function setFilePath($filePath, $title = null)
    {
        $this->filePath = $filePath;
        $fns = AliyunVodUtils::getFileName($this->filePath);
        $this->fileName = $fns[0];
        $extName = AliyunVodUtils::getFileExtension($this->fileName);
        if (empty($extName)) {
            throw new Exception('filePath has no Extension', 'InvalidParameter');
        }
        $this->mediaExt = $extName;

        if (isset($title)) {
            $this->title = $title;
        } else {
            if (! isset($this->title)) {
                $this->title = $fns[1];
            }
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMediaExt()
    {
        return $this->mediaExt;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getCateId()
    {
        return $this->cateId;
    }

    public function setCateId($cateId)
    {
        $this->cateId = $cateId;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCoverURL()
    {
        return $this->coverURL;
    }

    public function setCoverURL($coverURL)
    {
        $this->coverURL = $coverURL;
    }

    public function getTemplateGroupId()
    {
        return $this->templateGroupId;
    }

    public function setTemplateGroupId($templateGroupId)
    {
        $this->templateGroupId = $templateGroupId;
    }

    public function getIsShowWatermark()
    {
        return $this->isShowWatermark;
    }

    // 关闭水印，仅用于配置全局水印且转码模板开启水印后，单次上传时关闭水印
    public function shutdownWatermark()
    {
        $this->isShowWatermark = false;
    }

    public function getWatermarkSwitch()
    {
        return $this->isShowWatermark;
    }

    public function getStorageLocation()
    {
        return $this->storageLocation;
    }

    public function setStorageLocation($storageLocation)
    {
        $this->storageLocation = $storageLocation;
    }

    public function getUserData()
    {
        return $this->userData;
    }

    public function setUserData($userData)
    {
        $this->userData = $userData;
    }

    private $filePath = null;
    private $title = null;
    private $fileName = null;
    private $mediaExt = null;
    private $cateId = null;
    private $tags = null;
    private $description = null;
    private $coverURL = null;
    private $templateGroupId = null;
    private $isShowWatermark = null;
    private $storageLocation = null;
    private $userData = null;
}