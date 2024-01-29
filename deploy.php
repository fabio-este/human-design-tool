<?php

namespace Deployer;

require 'recipe/common.php';
require 'contrib/rsync.php';
require 'recipe/symfony.php';

date_default_timezone_set('Europe/Berlin');



// Project name
set('application', 'Human Design Tools');

// Import hosts
import('servers.yaml');

// Public dir
set('typo3_public', 'public');

// Project repository
set('repository', 'https://github.com/fabio-este/human-design-tool.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);


set('bin/php', static function () {
    if (has('bin')) {
        $bin = get('bin');
        if (is_array($bin) && isset($bin['php'])) {
            return $bin['php'];
        }
    }
    return locateBinaryPath('php');
});
set('bin/composer', static function () {
    if (has('bin')) {
        $bin = get('bin');
        if (is_array($bin) && isset($bin['composer'])) {
            return $bin['composer'];
        }
    }
    return locateBinaryPath('composer');
});

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);
set('ssh_multiplexing', false);
set('composer_options', '--prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');

set('cachetool_args', '--web --web-path={{deploy_path}}/current/public --web-url=https://{{htaccess_credentials}}{{hostname}}');


// Shared files/dirs between deploys
// Shared files/dirs between deploys
add('shared_files', [
    'public/robots.txt',
    'public/.htaccess',
    '.env.local',
]);

//add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', [
    'var',
    'var/cache',
    'var/log',
    'var/sessions',
]);

// Writable options
set('writable_tty', true);
set('writable_mode', 'chmod');
set('writable_use_sudo', false);
set('writable_chmod_mode', '0775');
set('writable_chmod_recursive', true);

set('allow_anonymous_stats', false);

// Tasks
task('symlink:public', function () {
    run('ln -s {{release_path}}/public/*  /www &&  ln -s {{release_path}}/public/.[^.]* /www');
});

task('cache:clear', function () {
    run('php {{release_path}}/bin/console cache:clear');
});

/* Is used when symlink from public folder doesn't behave as expected.
 * The downside of using it this way is that it doesn't remove files no longer present in git repo.
 * Assumed public directory is /www
 */
task('copy:public', function () {
    run('cp -R {{release_path}}/public/*  /www && cp -R {{release_path}}/public/.[^.]* /www');
});

/* Uploads built assets from local to remote. Requires rsync.
 * Useful when you use Symfony encore/webpack and remote machine doesn't support npm/yarn.
 */
task('upload:build', function () {
    upload("public/build/", '{{release_path}}/public/build/');
});

task('init:database', function () {
    run('{{bin/php}} {{bin/console}} doctrine:schema:create');
});

task('echo:options', function () {
    writeln('OPTIONS: {{composer_options}}');
});

task('build', function () {
    run('cd {{release_path}} && build');
});

task('assets:install', function () {
    run('{{bin/php}} {{bin/console}} assets:install');
});

task('cachetool:clear:decide', function () {
    if (has('  cachetool')) {
        invoke('cachetool:clear:opcache');
    }
});
