<?php

namespace Yaroskov\Resource\Components;

use Yaroskov\Data\Data;

class Page
{
    protected $url;

    protected $addHeaders;
    protected $postFields = false;
    protected $isHeader = false;
    protected $proxy = false;
    protected $timeout = 40;

    /**
     * Page constructor.
     * @param PageBuilder $pageBuilder
     */
    public function __construct(PageBuilder $pageBuilder)
    {
        $this->url = $pageBuilder->url;
        $this->addHeaders = $pageBuilder->addHeaders;
        $this->postFields = $pageBuilder->postFields;
        $this->isHeader = $pageBuilder->isHeader;
        $this->proxy = $pageBuilder->proxy;
        $this->timeout = $pageBuilder->timeout;
    }

    /**
     * @return string
     */
    public function data(): string
    {
        $httpHeaders = array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9',
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.75 Safari/537.36',
        );

        if (isset($this->addHeaders)) {
            $httpHeaders = Data::ArrayToArray($httpHeaders, $this->addHeaders);
        }

        $options = array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => $this->isHeader,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $httpHeaders,
            CURLOPT_POST => $this->postFields ? true : false,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'
        );

        if ($this->postFields) {
            $options[CURLOPT_POSTFIELDS] = $this->postFields;
        }

        if ($this->proxy) {
            $options[CURLOPT_PROXY] = $this->proxy;
        }

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $page = curl_exec($curl);
        curl_close($curl);

        return $page;
    }
}