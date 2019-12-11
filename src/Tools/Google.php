<?php

namespace Bozhilin\Translator\Tools;

use Exception;
use Ixudra\Curl\Facades\Curl;
use Bozhilin\Translator\Interfaces\TranslateInterface;

class Google implements TranslateInterface
{
    public function translate(array $data)
    {
        $response = Curl::to($data['api_url'])
            ->withData([
                'query' => $data['query'],
                'sourceLang' => $data['source'],
                'targetLang' => $data['target']
            ])
            ->asJson()
            ->post();
            
        if (!$response) {
            throw new Exception('Translator connect error. Please check your network status or url set up correctly.');
        }
        
        if (isset($response->error)) {
            throw new Exception($response->error);
        }
        
        return $response->extract->translation;
    }
}
