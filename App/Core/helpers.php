<?php

function base_path(string $path = ''): string {
    return dirname(__DIR__, 2) . ($path ? DIRECTORY_SEPARATOR . $path : '');
}

function resource_path(string $path = ''): string {
    return base_path('resources') . ($path ? DIRECTORY_SEPARATOR . $path : '');
}

function config_path(string $path = ''): string {
    return base_path('config') . ($path ? DIRECTORY_SEPARATOR . $path : '');
}

function view(string $template, array $data = []): void {
    extract($data);

    ob_start();
    require base_path("resources/views/{$template}.php");
    $content = ob_get_clean();

    require base_path('resources/views/layouts/base.php');
}
?>