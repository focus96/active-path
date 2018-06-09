<?php

namespace TarasenkoEvgenii\ActivePath;

use Illuminate\Support\Facades\Request;

class ActivePath
{
    protected $activeClass = ' active ';

    protected $inactiveClass = ' ';

    protected $configFile = 'activepath';

    /**
     * Проврка сотвествия текущего url по наименованию меню и его пункта.
     * Это необходимо, когда на странице большое количество меню
     * или когда одному пункту меню соответсвует большое количесво адресов.
     * Соответвие адресов пунктам меню находится в файле конфигов config/activepath.php
     *
     * @param string $navName - наименование пункта меню.
     * @param string|null $className - класс активного пункта меню.
     *
     * @return string
     *
     * @format $navMane - 'menuName.navItemName'
     */
    public function isNav(string $navName, string $className = null): string
    {
        $urls = config( $this->configFile . '.' . $navName);

        if (is_null($urls)) {
            return $this->inactiveClass;
        } elseif (!is_array($urls)) {
            return Request::is($urls) ? ($className ?? $this->activeClass) : $this->inactiveClass;
        } else {
            foreach ($urls as $url) {
                if (Request::is($url)) return ($className ?? $this->activeClass);
            }
        }

        return $this->inactiveClass;
    }

    /**
     * Проверка соответствия переданного пункта меню текущему.
     *
     * @param string $path - проверяемый урл.
     * @param string|null $className - класс активного пункта меню.
     *
     * @return string
     */
    public function isPath(string $path, string $className = null): string
    {
        return Request::is($path) ? ($className ?? $this->activeClass) : $this->inactiveClass;
    }

    /**
     * Проверка соотествия переданного сегмента пути текущему.
     *
     * @param int $segment - порядковый номер сегмента.
     * @param string|array $value - значение/я сегмента.
     * @param string|null $className - класс активного пункта меню.
     *
     * @return string
     */
    public function isSegment(int $segment, $value, string $className = null): string
    {
        if (!is_array($value)) {
            return Request::segment($segment) == $value ? ($className ?? $this->activeClass) : $this->inactiveClass;
        }
        foreach ($value as $v) {
            if (Request::segment($segment) == $v) return ($className ?? $this->activeClass);
        }
        return $this->inactiveClass;
    }

    public function setActiveClass(string $className): void
    {
        $this->activeClass = ' ' . $className . ' ';
    }

    public function setInactiveClass(string $inactiveClass)
    {
        $this->inactiveClass = $inactiveClass;
    }

    public function setConfigFile(string $configFile)
    {
        $this->configFile = $configFile;
    }
}