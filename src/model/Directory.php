<?php
namespace app;
require_once __DIR__ . '/../autoloadApp.php';

class Directory{
    public $path;

    public array $files;

    public array $directories;

    public $metadata;
}