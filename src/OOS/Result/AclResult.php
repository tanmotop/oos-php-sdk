<?php

namespace Tanmo\OOS\Result;

use Tanmo\OOS\Core\OosException;
use Tanmo\OOS\Model\BucketAcl;
use Tanmo\OOS\Model\Owner;
use Tanmo\OOS\Model\Grantee;

/**
 * The type of the return value of getBucketAcl, it wraps the data parsed from xml.
 *
 * @package Tanmo\OOS\Result
 */
class AclResult extends Result
{
    /**
     * @return BucketAcl
     * @throws OosException
     */
    public function parseDataFromResponse()
    {
        $granteeList = array();

        $content = $this->rawResponse->body;
        $xml = simplexml_load_string($content);

        if (empty($content)) {
            throw new OosException("body is null");
        }
        $id = "";
        $displayName = "";
        if (isset($xml->Owner) && isset($xml->Owner->ID)) {
            $id = strval($xml->Owner->ID);
        }
        if (isset($xml->Owner) && isset($xml->Owner->DisplayName)) {
            $displayName = strval($xml->Owner->DisplayName);
        }
        $owner = new Owner($id,$displayName);

        if (isset($xml->AccessControlList->Grant)) {
            $grantListInfo = $xml->AccessControlList->Grant;

            foreach ($grantListInfo as $grantInfo) {
                $grantee = new Grantee(
                    strval($grantInfo->Grantee->URI),
                    strval($grantInfo->Permission)
                );
                $granteeList[] = $grantee;
            }

        }

        $bucketAcl = new BucketAcl($owner,$granteeList);
        return $bucketAcl;
    }
}
