<?php

namespace Bozhilin\Translator\Interfaces;

interface TranslateInterface
{
    /**
     * Translate by curl
     * 
     * @param array $data
     * 
     * @return string
     */
    public function translate(array $data);
}
