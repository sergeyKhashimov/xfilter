<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 10:00
 */

namespace sergey_h\xfilter\behaviors\types;



use sergey_h\xfilter\behaviors\XFilterBehavior;

class XFFloat extends XFilterBehavior
{

    public $behaviors = [];

    function getType()
    {
        return self::FLOAT;
    }
}