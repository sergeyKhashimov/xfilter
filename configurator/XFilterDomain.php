<?php

namespace sergey_h\xfilter\configurator;

/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 7/6/17
 * Time: 10:31 PM
 */
interface XFilterDomain
{

    /** sets array of fields need to filter
     *
     * @return mixed
     */
     function configure();

}