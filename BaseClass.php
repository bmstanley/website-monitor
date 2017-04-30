<?php

class BaseClass
{
    /**
     * Holds the configuration settings
     * @var array
     */
    protected $config;

    public function __construct()
    {
        $this->config = include("config/config.php");
    }
}
