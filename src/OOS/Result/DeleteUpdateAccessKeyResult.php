<?php

namespace Tanmo\OOS\Result;
use Tanmo\OOS\Model\DeleteUpdateAccessKeyInfo;
use Tanmo\OOS\Core\OosException;
/**
 * Class DeleteUpdateAccessKeyResult
 * @package Tanmo\OOS\Result
 */
class DeleteUpdateAccessKeyResult extends Result
{
    /**
     * @return DeleteUpdateAccessKeyInfo
     * @throws
     */
    public function parseDataFromResponse()
    {
        $strXml = $this->rawResponse->body;
        if (empty($strXml)) {
            throw new OosException("body is null");
        }

        $deleteUpdateAccessKeyInfo = new DeleteUpdateAccessKeyInfo();

        $xml = simplexml_load_string($strXml);
        $requestId = "";
        if (isset($xml->ResponseMetadata->RequestId)){
            $requestId = strval($xml->ResponseMetadata->RequestId);
        }
        $deleteUpdateAccessKeyInfo->setRequestId($requestId);

        return $deleteUpdateAccessKeyInfo;
    }
}
