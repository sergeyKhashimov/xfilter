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

    public $behaviors = [
        'equal',
        'not_equal',
        'greater_than',
        'less_than',
        'greater_or_equal',
        'less_or_equal',
        'in',
        'not_in',
        'between',
        'not_between',
        'null',
        'not_null',
    ];

    function getType()
    {
        return self::FLOAT;
    }
}