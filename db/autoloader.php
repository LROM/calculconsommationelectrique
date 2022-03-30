<?php
register_autoloaders();

function register_autoloaders()
{
    spl_autoload_register('autoload_modelrepository');
    spl_autoload_register('autoload_model');
}

function autoload_modelrepository($class)
{
    //echo "Repo : $class\n";
    $file = 'db/model-repository/'.$class.'.php';
    if (is_readable($file))
    {
        require_once $file;
    }
}

function autoload_model($class)
{
    //echo "Model : $class\n";
    $file = 'db/model/'.$class.'.php';
    if (is_readable($file))
    {
        require_once $file;
    }
}