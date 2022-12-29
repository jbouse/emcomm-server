<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use sixlive\DotenvEditor\DotenvEditor;

#[AsCommand(
    name: 'regenerate-app-secret',
    description: 'Regenerates the Symfony App Secret',
)]
class RegenerateAppSecretCommand extends Command
{
    protected function configure(): void
    {
        $this->addArgument('envfile', InputArgument::REQUIRED, 'The .env File {.env, .env.local, etc}');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $envname = $input->getArgument('envfile');

        if ($envname && ($envname == '.env' || str_starts_with($envname, '.env.')))
        {
            $secret = bin2hex(random_bytes(16));
            $filepath = realpath(dirname(__file__).'/../..') . '/' . $envname;

            $editor = new DotenvEditor();
            if (file_exists($filepath)) {
                $editor->load($filepath);
                $io->note(sprintf('Editing file: %s', $filepath));
            } else {
                $io->note(sprintf('Creating file: %s', $filepath));
            }
            $editor->set('APP_SECRET', $secret);
            $editor->save($filepath);

            $io->success(sprintf('New APP_SECRET was generated: %s', $secret));

            return Command::SUCCESS;
            
        }

        $io->error('You did not provide a valid environment file to change');
        return Command::INVALID;
    }
}
