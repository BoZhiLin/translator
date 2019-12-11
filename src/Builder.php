<?php

namespace Bozhilin\Translator;

use Exception;
use Bozhilin\Translator\Tools\Google;

class Builder
{
    private $config;

    protected $string;

    protected $source;

    protected $target;

    public function __construct()
    {
        if (config('translate')) {
            $this->config = config('translate');
        } else {
            $this->config = include(__DIR__.'/../config/translate.php');
        }
    }

    /**
     * Set string which will be translated.
     * 
     * @param string $string
     * 
     * @return TranslateManager
     */
    public function query($string)
    {
        if (!$string) {
            throw new Exception('Please press your string.');
        }

        $this->string = $string;
        return $this;
    }

    /**
     * Set source language
     * 
     * @param string $source
     * 
     * @return TranslateManager
     */
    public function from($source = 'zh-TW')
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Set target language
     * 
     * @param string $target
     * 
     * @return TranslateManager
     */
    public function to($target = 'en')
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Call handle method to get result by curl.
     * 
     * @return mixed
     */
    public function post()
    {
        return $this->handle();
    }

    /**
     * Translate string from "source" to "target"
     * 
     * @return string
     */
    protected function handle()
    {
        $driver = $this->config['defaults']['driver'];

        if (!array_key_exists($driver, $this->config['drivers'])) {
            throw new Exception('Driver does not exists.');
        }

        $data = [
            'api_url' => $this->config['drivers'][$driver]['api_url'],
            'query' => $this->string,
            'source' => $this->source,
            'target' => $this->target
        ];
        
        switch ($driver) {
            case 'google':
                return (new Google())->translate($data);
                break;

            default:
                throw new Exception('Translate error. Please check your driver.');
                break;
        }
    }
}
