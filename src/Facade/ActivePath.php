<?php

namespace TarasenkoEvgenii\ActivePath\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class ActivePath
 * Фаслад для класса ActivePath.
 *
 * @package TarasenkoEvgenii\ActivePath\Facade
 */
class ActivePath extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'activePath';
    }
}