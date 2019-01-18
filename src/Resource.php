<?php

namespace Yaroskov\Resource;

use Yaroskov\Resource\Components\PageBuilder;

class Resource
{
    /**
     * @param string $url
     * @return PageBuilder
     */
    public static function page(string $url): PageBuilder
    {
        return new PageBuilder($url);
    }
}