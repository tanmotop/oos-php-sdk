<?php

namespace Tanmo\OOS\Result;


use Tanmo\OOS\Model\LifecycleConfig;

/**
 * Class GetLifecycleResult
 * @package Tanmo\OOS\Result
 */
class GetLifecycleResult extends Result
{
    /**
     *  Parse the LifecycleConfig object from the response
     *
     * @return LifecycleConfig
     * @throws
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new LifecycleConfig();
        $config->parseFromXml($content);
        return $config;
    }

}
