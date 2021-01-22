<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Core\OosUtil;
use Tanmo\OOS\Model\GetObjectInfo;
use Tanmo\OOS\Model\ObjectInfo;
use Tanmo\OOS\Model\ObjectListInfo;
use Tanmo\OOS\Model\PrefixInfo;

/**
 * Class GetObjectResult
 * @package Tanmo\OOS\Result
 */
class GetObjectResult extends Result
{
    /**
     * Parse the xml data returned by the ListObjects interface
     *
     * @return GetObjectInfo
     */

    public function parseDataFromResponse()
    {
        $getObectInfo = new GetObjectInfo();
        $rawResponseHeader = $this->rawResponse->header;

        $getObectInfo->setContent(empty($this->rawResponse->body) ? "" : $this->rawResponse->body);

        //Last-Modified
        $getObectInfo->setLastModified(isset($rawResponseHeader["last-modified"]) ?
              $rawResponseHeader["last-modified"] : "") ;

        $getObectInfo->setETag(isset($rawResponseHeader["etag"]) ?
             $rawResponseHeader["etag"] : "");

        $getObectInfo->setExpiration(isset($rawResponseHeader["x-amz-expiration"]) ?
            $rawResponseHeader["x-amz-expiration"] : "");

        if(isset($rawResponseHeader["x-ctyun-metadata-location"]))
        {
            $getObectInfo->setMetaLocation($rawResponseHeader["x-ctyun-metadata-location"]);
        }

        if(isset($rawResponseHeader["x-ctyun-data-location"]))
        {
            $getObectInfo->setDataLocation($rawResponseHeader["x-ctyun-data-location"]);
        }

        return $getObectInfo;
    }
}
