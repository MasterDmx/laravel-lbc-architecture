<?php

namespace MasterDmx\LbcArchitecture\Console;

use Illuminate\Console\Command;

class LbcInstallCommand extends Command
{
    protected $signature = 'lbc:install';

    protected $description = 'Transforms the standard architecture';

    public function handle()
    {
        $this->createDirectory('App');
        $this->createDirectory('Domain');
        $this->createDirectory('Support');

        // Переносим все папки в APP
        $this->transfer('Console');
        $this->transfer('Exceptions');
        $this->transfer('Http');
        $this->transfer('Providers');
        $this->transfer('Models');

        // Копируем файл Application в App
        copy($this->getPackagePath() . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'Application.php', app_path('App' . DIRECTORY_SEPARATOR . 'Application.php'));

        // Копируем файл функций
        copy($this->getPackagePath() . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'functions.php', app_path('functions.php'));

        // Получаем содержимое bootstrap\app.php
        $bootstrapApp = file_get_contents(base_path('bootstrap' . DIRECTORY_SEPARATOR . 'app.php'));

        // Ищем инициализацию $app
        $search = '$app = new Illuminate\Foundation\Application(
    $_ENV[\'APP_BASE_PATH\'] ?? dirname(__DIR__)
);';

        // Подменяем стандартный app нашим
        $replace = '$app = new App\Application(
    $_ENV[\'APP_BASE_PATH\'] ?? dirname(__DIR__)
);
$app->useAppPath(\'app/App\');';

        // Перезаписываем файл bootstrap\app.php
        file_put_contents(base_path('bootstrap' . DIRECTORY_SEPARATOR . 'app.php'), str_replace($search, $replace, $bootstrapApp));

        // Получаем содержимое composer.json
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        // Добавляем подгрузку файла функций + изменяем дефолтный app на связку App | Domain | Support
        $composer['autoload']['files'][]            = 'app/functions.php';
        $composer['autoload']['psr-4']['App\\']     = 'app/App';
        $composer['autoload']['psr-4']['Domain\\']  = 'app/Domain';
        $composer['autoload']['psr-4']['Support\\'] = 'app/Support';

        // Перезаписываем composer.json
        file_put_contents(base_path('composer.json'), json_encode($composer, , JSON_PRETTY_PRINT));

        $this->info('Done. Run composer dump-autoload');
    }

    /**
     * Переносит файлы и папки
     *
     * @param string $name
     * @param string $to
     */
    private function transfer (string $name, string $to = 'App')
    {
        if (file_exists(app_path($name))) {
            rename(app_path($name), empty($to) ? app_path($name) : app_path($to . DIRECTORY_SEPARATOR . $name));
        }
    }

    /**
     * Создает каталог внутри папки app
     *
     * @param string $name
     */
    private function createDirectory(string $name)
    {
        if (!file_exists(app_path($name))) {
            mkdir(app_path($name));
        }
    }

    /**
     * Путь до папки с пакетом
     *
     * @return string
     */
    private function getPackagePath(): string
    {
        return substr(__DIR__, 0, -12);
    }
}
