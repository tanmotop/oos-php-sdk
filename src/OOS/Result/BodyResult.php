<?php

namespace Tanmo\OOS\Result;


/**
 * Class BodyResult
 * @package Tanmo\OOS\Result
 */
class BodyResult extends Result
{
    /**
     * @return string
     */
    protected function parseDataFromResponse()
    {
        return empty($this->rawResponse->body) ? "" : $this->rawResponse->body;
    }
}
