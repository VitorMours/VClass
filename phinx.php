<?php

$config = parse_ini_file(__DIR__ . '/config.ini', true);
$dbPath = $config['database']['database_path'] ?? 'database/banco.sqlite';

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'sqlite',
            'name'    => __DIR__ . '/' . $dbPath
        ]
    ],
    'version_order' => 'creation'
];