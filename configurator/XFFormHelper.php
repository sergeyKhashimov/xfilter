<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 11:43
 */

namespace sergey_h\xfilter\configurator;


/**
 * Class XFFormHelper
 * @package app\modules\fl\xfilter\configurator
 */
class XFFormHelper
{

    /** Makes input names like 'name_1' to 'name'
     *
     * @param $name
     *
     * @return string
     */
    public static function trimName($name)
    {
        return trim(trim($name,'1234567890' ),'|');

    }

}