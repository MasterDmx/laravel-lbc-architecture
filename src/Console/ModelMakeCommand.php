<?php

namespace MasterDmx\LbcArchitecture\Console;

use Illuminate\Foundation\Console\ModelMakeCommand as BaseModelMakeCommand;

class ModelMakeCommand extends BaseModelMakeCommand
{
    protected function rootNamespace()
    {
        return config('lbc_architecture.domain_namespace');
    }

    protected function getPath($name)
    {
        return str_replace(
            $this->laravel['path'],
            config('lbc_architecture.domain_path'),
            parent::getPath($name)
        );
    }
}
