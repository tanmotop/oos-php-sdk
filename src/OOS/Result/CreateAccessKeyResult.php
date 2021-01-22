<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Model\KeyInfo;
use Tanmo\OOS\Model\ListKeyInfo;

/**
 * Class ListBucketsResult
 *
 * @package Tanmo\OOS\Result
 */
class CreateAccessKeyResult extends Result
{
    /**
     * @return KeyInfo
     */
    protected function parseDataFromResponse()
    {
        $keyInfo = new KeyInfo("","","","","");
        $content = $this->rawResponse->body;
        $xml = new \SimpleXMLElement($content);
        if (isset($xml->CreateAccessKeyResult)
            && isset($xml->CreateAccessKeyResult->AccessKey)
        ) {

            $keyInfo = new KeyInfo(
                strval($xml->CreateAccessKeyResult->AccessKey->UserName),
                strval($xml->CreateAccessKeyResult->AccessKey->AccessKeyId),
                strval($xml->CreateAccessKeyResult->AccessKey->Status),
                strval($xml->CreateAccessKeyResult->AccessKey->SecretAccessKey),
                strval($xml->CreateAccessKeyResult->AccessKey->IsPrimary)
            );
        }
        return $keyInfo;
    }
}
