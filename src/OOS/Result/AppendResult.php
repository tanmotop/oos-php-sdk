<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Core\OosException;

/**
 * Class AppendResult
 * @package Tanmo\OOS\Result
 */
class AppendResult extends Result
{
    /**
     * Get the value of next-append-position from append's response headers
     *
     * @return int
     * @throws OosException
     */
    protected function parseDataFromResponse()
    {
        $header = $this->rawResponse->header;
        if (isset($header["x-amz-next-append-position"])) {
            return intval($header["x-amz-next-append-position"]);
        }
        throw new OosException("cannot get next-append-position");
    }
}
