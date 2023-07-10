<?php

namespace app\dto;


class Dto
{
    public function __construct($attributes)
    {
        foreach ($attributes as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}