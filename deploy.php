<?php

namespace Deployer;

require 'recipe/laravel.php';

set('repository', 'https://github.com/DWES-Batoi/sa3-arquitetura-mvc-amb-laravel-AlejandroRS123.git');
set('bin/php', '/usr/bin/php');
add('shared_files', ['.env']);
add('shared_dirs', ['storage', 'bootstrap/cache']);
add('writable_dirs', ['storage', 'bootstrap/cache']);
task('artisan:migrate', function () {})->desc('Skipping database migration (No DB required)');
task('artisan:event:cache', function () {})->desc('Skipping event cache');
task('deploy:build', function () {
    run('cd {{release_path}} && npm install && npm run build');
})->desc('Installs node dependencies and compiles assets for production');
host('production')
    ->set('hostname', '54.82.127.166')
    ->set('remote_user', 'sa04-deployer')
    ->set('deploy_path', '/var/www/es-cipfpbatoi-deployer/html');
before('deploy:symlink', 'deploy:build');
after('deploy:failed', 'deploy:unlock');
task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php8.3-fpm restart');
});
after('deploy', 'reload:php-fpm');
