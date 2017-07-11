<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 10:01
 */

namespace sergey_h\xfilter\behaviors\types;


use sergey_h\xfilter\behaviors\XFilterBehavior;

class XFString extends XFilterBehavior
{
    public $behaviors = [
        'equal',
        'not_equal',
        'in',
        'not_in',
        'like',
        'not_like',
        'null',
        'not_null',
    ];

    function getType()
    {
        return self::STRING;
    }
}