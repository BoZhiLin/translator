<?php

namespace Bozhilin\Translator;

use Exception;
use Ixudra\Curl\Facades\Curl;

class Builder
{
    /**
     * @var string $string
     */
    protected $string;

    /**
     * @var string $source
     */
    protected $source;

    /**
     * @var string $target
     */
    protected $target;

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
        $response = Curl::to('https://google-translate-proxy.herokuapp.com/api/translate')
            ->withData([
                'query' => $this->string,
                'sourceLang' => $this->source,
                'targetLang' => $this->target
            ])
            ->asJson()
            ->post();

        if (!$response) {
            throw new Exception('Translator connect error. Please check your network status or url set up correctly.');
        }

        if (isset($response->error)) {
            return new Exception($response->error);
        }
        
        return $response->extract->translation;
    }
}
