## Translator for Laravel By BoZhiLin

### Install
```
$ composer require bozhilin/translator
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