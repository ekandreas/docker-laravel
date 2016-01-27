<?php

task('docker:start', function () {
    
    $machine = new EkAndreas\DockerBedrock\Machine();
    $machine->ensure();

    $mysql_name = get('docker.container') . '_mysql';
    $mysql = new EkAndreas\DockerBedrock\Mysql($mysql_name);
    $mysql->ensure();

    $elastic_name = get('docker.container') . '_elastic';
    $elastic = new EkAndreas\DockerBedrock\Elasticsearch($elastic_name);
    $elastic->ensure();

    $web_name = basename(EkAndreas\DockerBedrock\Helpers::getProjectDir());
    $web = new EkAndreas\DockerBedrock\Web($web_name);
    $web->ensure();

}, 999);

task('docker:up', function () {
    
    $machine = new EkAndreas\DockerBedrock\Machine();
    $machine->ensure();

    $mysql_name = get('docker.container') . '_mysql';
    $mysql = new EkAndreas\DockerBedrock\Mysql($mysql_name);
    $mysql->ensure();

    $elastic_name = get('docker.container') . '_elastic';
    $elastic = new EkAndreas\DockerBedrock\Elasticsearch($elastic_name);
    $elastic->ensure();

    $web_name = basename(EkAndreas\DockerBedrock\Helpers::getProjectDir());
    $web = new EkAndreas\DockerBedrock\Web($web_name);
    $web->ensure();

}, 999);

task('docker:stop', function () {
    
    $mysql_name = get('docker.container') . '_mysql';
    $mysql = new EkAndreas\DockerBedrock\Mysql($mysql_name);
    $mysql->stop();

    $elastic_name = get('docker.container') . '_elastic';
    $elastic = new EkAndreas\DockerBedrock\Elasticsearch($elastic_name);
    $elastic->stop();

    $web_name = basename(EkAndreas\DockerBedrock\Helpers::getProjectDir());
    $web = new EkAndreas\DockerBedrock\Web($web_name);
    $web->stop();

});

task('docker:halt', function () {
    
    $mysql_name = get('docker.container') . '_mysql';
    $mysql = new EkAndreas\DockerBedrock\Mysql($mysql_name);
    $mysql->stop();

    $elastic_name = get('docker.container') . '_elastic';
    $elastic = new EkAndreas\DockerBedrock\Elasticsearch($elastic_name);
    $elastic->stop();

    $web_name = basename(EkAndreas\DockerBedrock\Helpers::getProjectDir());
    $web = new EkAndreas\DockerBedrock\Web($web_name);
    $web->stop();

});

task('docker:kill', function () {
    
    $mysql_name = get('docker.container') . '_mysql';
    $mysql = new EkAndreas\DockerBedrock\Mysql($mysql_name);
    $mysql->kill();

    $elastic_name = get('docker.container') . '_elastic';
    $elastic = new EkAndreas\DockerBedrock\Elasticsearch($elastic_name);
    $elastic->kill();

    $web_name = basename(EkAndreas\DockerBedrock\Helpers::getProjectDir());
    $web = new EkAndreas\DockerBedrock\Web($web_name);
    $web->kill();

});
