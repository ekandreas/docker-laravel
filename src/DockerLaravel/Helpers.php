<?php

namespace EkAndreas\DockerLaravel;

class Helpers
{
    public static function start()
    {
        $machine = new Machine();
        $machine->ensure();

        $mysql_name = env('container').'_mysql';
        $mysql = new Mysql($mysql_name);
        $mysql->ensure();

        $web_name = basename(self::getProjectDir());
        $web_name .= '_web';
        $web = new Web($web_name);
        $web->ensure();
    }

    public static function stop()
    {
        $mysql_name = env('container').'_mysql';
        $mysql = new Mysql($mysql_name);
        $mysql->stop();

        $web_name = basename(self::getProjectDir());
        $web_name .= '_web';
        $web = new Web($web_name);
        $web->stop();
    }

    public static function kill()
    {
        $mysql_name = env('container').'_mysql';
        $mysql = new Mysql($mysql_name);
        $mysql->kill();

        $web_name = basename(self::getProjectDir());
        $web_name .= '_web';
        $web = new Web($web_name);
        $web->kill();
    }

    public static function cleanup()
    {
        $web_name = basename(self::getProjectDir());
        $web_name .= '_web';
        $web = new Web($web_name);
        $web->stop();
        $web->kill();

        $image_id = null;
        $command = "docker images";
        $output = Helpers::doLocal($command);
        $container = env('container');
        $pattern = '#'.$container.'\s.*latest\s+(.*?)\s#i';
        if (preg_match($pattern, $output, $matches)) {
            $image_id = $matches[1];
        }

        if($image_id) {
            Helpers::doLocal('docker rmi -f '.$image_id);
        }
    }

    public static function waitForPort($waiting_message, $ip, $port)
    {
        write($waiting_message);
        while (!self::portAlive($ip, $port)) {
            sleep(1);
            write('.');
        }
        writeln("<fg=green>Up!</fg=green> Connect at <fg=yellow>=> $ip:$port</fg=yellow>");
    }

    public static function portAlive($ip, $port)
    {
        $result = false;
        try {
            if (@fsockopen($ip, $port, $errno, $errstr, 5)) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public static function getMachineIp()
    {
        $result = '';

        if (has('docker.machine.ip')) {
            $result = get('docker.machine.ip');

            return $result;
        } else {
            $docker_name = env('server.host');
            writeln("Getting environment data from $docker_name");
            $output = runLocally("docker-machine env $docker_name");
            if (preg_match('#DOCKER_HOST\=\"tcp:\/\/(.*):#i', $output, $matches)) {
                $result = $matches[1];
            }
            set('docker.machine.ip', $result);

            return $result;
        }
    }

    public static function getPackageDir()
    {
        $dir = realpath(__DIR__.'/../../');

        return $dir;
    }

    public static function getProjectDir()
    {
        $dir = self::getPackageDir();
        $web_dir = realpath("$dir/../../../");

        return $web_dir;
    }

    public static function doLocal($command, $timeout = 999)
    {
        writeln('===================================================');
        writeln('Running command:');
        writeln($command);
        writeln('===================================================');

        return runLocally(Env::evalDocker().$command, $timeout);
    }
}
