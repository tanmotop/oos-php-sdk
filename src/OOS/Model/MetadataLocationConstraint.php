<?php


namespace Tanmo\OOS\Model;


class MetadataLocationConstraint
{
    public function __construct($location)
    {
        $this->location = $location;
    }
    private $location;

    public function getLocation(){
        return $this->location;
    }
}
