<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Core\OosException;

/**
 * Class UploadPartResult
 * @package Tanmo\OOS\Result
 */
class UploadPartResult extends Result
{
    /**
     * 结果中part的ETag
     *
     * @return string
     * @throws OosException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header["etag"])) {
            return $header["etag"];
        }
        throw new OosException("cannot get ETag");

    }
}
