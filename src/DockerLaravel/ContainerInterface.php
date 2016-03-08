<?php

namespace EkAndreas\DockerLaravel;

interface ContainerInterface
{
    public function ensure();

    public function exists();

    public function run();

    public function start();

    public function stop();

    public function kill();
}
