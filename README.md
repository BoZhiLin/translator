## Translator for Laravel By BoZhiLin

### Install
```
$ composer require bozhilin/translator
```

### Config
```
$ php artisan vendor:publish --provider="Bozhilin\Translator\Providers\TranslatorServiceProvider"
```

### Environment (optional)
Add a parameter into .env
Default value is google
```
TRANSLATOR_DRIVER=google
```

### Including
```php
use Bozhilin\Translator\Facades\Translate;
```

### Usage
```php
Translate::query('success')
    ->from('en')
    ->to('zh-TW')
    ->post();
    
// echo "成功"
```