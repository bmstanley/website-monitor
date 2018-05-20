<?php

namespace bmstanley;

final class Request
{
    /**
     * Website URL to test
     *
     * @var string
     */
    public $url;

    /**
     * HTTP status code
     *
     * @var integer
     */
    public $httpStatusCode;

    /**
     * Default request timeout
     */
    private const TIMEOUT = 120;

    /**
     * Create a new request
     *
     * @param string $url The URL to test in the request
     */
    public function __construct(string $url)
    {
        $this->url = $url;
        $curl = curl_init($this->url);
        curl_setopt_array(
            $curl,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CONNECTTIMEOUT => self::TIMEOUT,
                CURLOPT_TIMEOUT => self::TIMEOUT,
                CURLOPT_USERAGENT => 'cURL Request'
            ]
        );
        curl_exec($curl);
        $this->httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }

    /**
     * Return the HTTP status code of the request
     *
     * @return int HTTP status code
     */
    public function httpStatusCode() : int
    {
        return $this->httpStatusCode;
    }

    /**
     * Return the URL to which the request was sent
     *
     * @return string Requested URL
     */
    public function url() : string
    {
        return $this->url;
    }
}
