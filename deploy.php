<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'sps460-kgb');

// Project repository
set('repository', 'git@github.com:DoedeJaarsmaCommunicatie/sps460-kbg.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
host('staging')
    ->hostname('141.105.127.47')
    ->roles('app')
    ->port(33)
    ->user('midvast')
    ->set('deploy_path', '~/domains/aanmelden.spaarndammerstraat460.nl/public_html');


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
