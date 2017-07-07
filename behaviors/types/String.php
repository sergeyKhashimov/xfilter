<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 10:01
 */

namespace sergey_h\xfilter\behaviors\types;


use sergey_h\xfilter\behaviors\XFilterBehavior;

class String extends XFilterBehavior
{
    public $behaviors = [];

    function getType()
    {
        return self::STRING;
    }
}