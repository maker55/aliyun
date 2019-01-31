<?php

namespace Aliyun\OSS\Result;

use Aliyun\OSS\Core\OssException;
use Aliyun\OSS\OssClient;

/**
 *
 * @package OSS\Result
 */
class SymlinkResult extends Result
{
    /**
     * @return string
     * @throws OssException
     */
    protected function parseDataFromResponse()
    {
        $this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET] = rawurldecode($this->rawResponse->header[OssClient::OSS_SYMLINK_TARGET]);
        return $this->rawResponse->header;
    }
}

