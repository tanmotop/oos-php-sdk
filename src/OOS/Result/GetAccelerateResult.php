<?php

namespace Tanmo\OOS\Result;


use Tanmo\OOS\Model\AccelerateConfig;

/**
 * Class GetAccelerateResult
 * @package Tanmo\OOS\Result
 */
class GetAccelerateResult extends Result
{
    /**
     * Parse AccelerateConfig data
     *
     * @return AccelerateConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new AccelerateConfig();
        $config->parseFromXml($content);
        return $config;
    }

}
