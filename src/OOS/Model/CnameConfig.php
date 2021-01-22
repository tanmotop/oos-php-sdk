<?php

namespace Tanmo\OOS\Model;


use Tanmo\OOS\Core\OosException;

/**
 * Class CnameConfig
 * @package Tanmo\OOS\Model
 *
 */
class CnameConfig implements XmlConfig
{
    public function __construct()
    {
        $this->cnameList = array();
    }

    /**
     * @return array
     * @example
     *  array(2) {
     *    [0]=>
     *    array(3) {
     *      ["Domain"]=>
     *      string(11) "www.foo.com"
     *      ["Status"]=>
     *      string(7) "enabled"
     *      ["LastModified"]=>
     *      string(8) "20150101"
     *    }
     *    [1]=>
     *    array(3) {
     *      ["Domain"]=>
     *      string(7) "bar.com"
     *      ["Status"]=>
     *      string(8) "disabled"
     *      ["LastModified"]=>
     *      string(8) "20160101"
     *    }
     *  }
     */
    public function getCnames()
    {
        return $this->cnameList;
    }


    public function addCname($cname)
    {
        if (count($this->cnameList) >= self::OOS_MAX_RULES) {
            throw new OosException(
                "num of cname in the config exceeds self::OOS_MAX_RULES: " . strval(self::OOS_MAX_RULES));
        }
        $this->cnameList[] = array('Domain' => $cname);
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->Cname)) return;
        foreach ($xml->Cname as $entry) {
            $cname = array();
            foreach ($entry as $key => $value) {
                $cname[strval($key)] = strval($value);
            }
            $this->cnameList[] = $cname;
        }
    }

    public function serializeToXml()
    {
        $strXml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<BucketCnameConfiguration>
</BucketCnameConfiguration>
EOF;
        $xml = new \SimpleXMLElement($strXml);
        foreach ($this->cnameList as $cname) {
            $node = $xml->addChild('Cname');
            foreach ($cname as $key => $value) {
                $node->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    const OOS_MAX_RULES = 10;

    private $cnameList = array();
}