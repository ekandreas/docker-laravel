<?php

namespace EkAndreas\DockerLaravel;

class Container
{
    protected $ip;
    protected $port;
    protected $image;
    protected $container;
    protected $dir;
    protected $webdir;

    public function __construct($container_name)
    {
        $this->dir = Helpers::getPackageDir();
        $this->webdir = Helpers::getProjectDir();
        $this->image = has('docker.image') ? get('docker.image') : 'laravel';
        $this->container = $container_name;
        $this->ip = Helpers::getMachineIp();
    }
}
