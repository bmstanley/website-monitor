<?php

class Request
{
    /**
     * Website URL to test
     * @var string
     */
    public $url = 'best_website_ever';

    /**
     * HTTP status code
     * @var integer
     */
    public $httpStatusCode;

    /**
     * Default request timeout
     */
    const TIMEOUT = 120;

    public function __construct()
    {
        $curl = curl_init($this->url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => self::TIMEOUT,
            CURLOPT_TIMEOUT => self::TIMEOUT,
            CURLOPT_USERAGENT => 'cURL Request'
        ]);
        curl_exec($curl);
        $this->httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }

    /**
     * Return the HTTP status code of the request
     * @return int HTTP status code
     */
    public function httpStatusCode() : int
    {
        return $this->httpStatusCode;
    }
}
