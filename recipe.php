<?php

if (!class_exists('EkAndreas\DockerLaravel\Helpers')) {
    include_once 'src/DockerLaravel/Helpers.php';
}

use EkAndreas\DockerLaravel\Helpers;

$dir = Helpers::getProjectDir();
require_once $dir.'/vendor/autoload.php';

include_once 'common.php';

task('docker:start', function () {
    Helpers::start();
}, 999);

task('docker:up', function () {
    Helpers::start();
}, 999);

task('docker:stop', function () {
    Helpers::stop();
});

task('docker:halt', function () {
    Helpers::stop();
});

task('docker:kill', function () {
    Helpers::kill();
});
