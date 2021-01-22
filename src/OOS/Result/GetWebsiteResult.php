<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Model\WebsiteConfig;

/**
 * Class GetWebsiteResult
 * @package Tanmo\OOS\Result
 */
class GetWebsiteResult extends Result
{
    /**
     * Parse WebsiteConfig data
     *
     * @return WebsiteConfig
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $config = new WebsiteConfig();
        $config->parseFromXml($content);
        return $config;
    }


}
