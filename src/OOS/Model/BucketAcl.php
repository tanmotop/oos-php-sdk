<?php

namespace Tanmo\OOS\Model;
use Tanmo\OOS\Model\Owner;
use Tanmo\OOS\Model\Grantee;

/**
 * Class BucketAcl
 * @package Tanmo\OOS\Model
 */
class BucketAcl
{
    public function __construct($owner,$granteeList)
    {
        $this->owner = $owner;
        $this->granteeList = $granteeList;
    }

    /**
     *
     * @return Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     *
     * @return Grantee[]
     */
    public function getGranteeList()
    {
        return $this->granteeList;
    }

    private $owner;
    private $granteeList;
}


