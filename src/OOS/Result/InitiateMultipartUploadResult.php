<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Core\OosException;
use Tanmo\OOS\Model\InitiateMultipartUploadInfo;

/**
 * Class initiateMultipartUploadResult
 * @package Tanmo\OOS\Result
 */
class InitiateMultipartUploadResult extends Result
{
    /**
     * Get uploadId in result and return
     *
     * @throws OosException
     * @return InitiateMultipartUploadInfo
     */
    protected function parseDataFromResponse()
    {
        $strXml = $this->rawResponse->body;
        if (empty($strXml)) {
            throw new OosException("body is null");
        }

        $xml = simplexml_load_string($strXml);
        $initInfo = new InitiateMultipartUploadInfo();

        if (isset($xml->Bucket)) {
            $initInfo->setBucket(strval($xml->Bucket));
        }
        if (isset($xml->Key)) {
            $initInfo->setKey(strval($xml->Key));
        }
        if (isset($xml->UploadId)) {
            $initInfo->setUploadId(strval($xml->UploadId));
        }

        return $initInfo;
    }
}
