### Установка

1. Скачивание плагина
```
composer require masterdmx/laravel-lbc-architecture
```

2. Подключение провайдера в config app.php
```php
'providers' => [
    MasterDmx\LbcArchitecture\LbcServiceProvider::class,
]
```

### Автоматическое изменение архитектуры

```
php artisan lbc:install
```

### Дефолтные функции

Путь до app\App
```
lbc_app_path($path)
```

Путь до app\Domain
```
lbc_domain_path($path)
```

Путь до app\Support
```
lbc_support_path($path)
```

### Глобальные пользовательские функции
Для добавления своих функций, которые будут глобальными - необходимо внести их в следующий файл: 
```
app\functions.php
```
