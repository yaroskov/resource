<?php

namespace Yaroskov\Resource\Components;

class PageBuilder
{
    public $url;

    public $addHeaders;
    public $postFields = false;
    public $isHeader = false;
    public $proxy = false;
    public $timeout = 40;

    /**
     * PageBuilder constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param array $addHeaders
     * @return PageBuilder
     */
    public function addHeaders(array $addHeaders): PageBuilder
    {
        $this->addHeaders = $addHeaders;
        return $this;
    }

    /**
     * @param array $postFields
     * @return PageBuilder
     */
    public function postFields(array $postFields): PageBuilder
    {
        $this->postFields = $postFields;
        return $this;
    }

    /**
     * @return PageBuilder
     */
    public function isHeader(): PageBuilder
    {
        $this->isHeader = true;
        return $this;
    }

    /**
     * @param string $proxy
     * @return PageBuilder
     */
    public function proxy(string $proxy): PageBuilder
    {
        $this->proxy = $proxy;
        return $this;
    }

    /**
     * @param int $timeout
     * @return PageBuilder
     */
    public function timeout(int $timeout): PageBuilder
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return Page
     */
    public function get(): Page
    {
        return new Page($this);
    }
}