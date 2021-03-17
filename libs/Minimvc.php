<?php namespace Ramdan;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class Serve extends Command {
    protected $commandName = 'serve';
    protected $commandDescription = "Menjalankan aplikasi web di built-in php development web server";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $output->writeln(shell_exec('cd public && php -S localhost:8080'));

        return Command::SUCCESS;
    }
}

class Webset extends Command {
    protected function configure()
    {
        $this
            ->setName('app:webset')
            ->setDescription('Untuk menulis .htaccess di root project')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $f = fopen('.htaccess', 'w');
        $txt = "Options -Multiviews\nRewriteEngine On\nRewriteRule ^(.*)$ public/index.php [L]";
        fwrite($f,$txt);
        fclose($f);
        $output->writeln('Success configuring app for any apache / nginx server');
        return Command::SUCCESS;
    }
}