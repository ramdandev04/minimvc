<?php namespace Ramdan;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Minimvc extends Command {
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
