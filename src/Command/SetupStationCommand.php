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
    name: 'emcomm:station:setup',
    description: 'Setup environment for station operations',
)]
class SetupStationCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('station', InputArgument::OPTIONAL, 'Station Callsign')
            ->addOption('replies', null, InputOption::VALUE_NEGATABLE, 'Does station accepts replies')
            ->addOption('mboxpath', null, InputOption::VALUE_REQUIRED, 'Station PAT mailbox path')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $envname = '.env.local';

        $station = $input->getArgument('station');

        if ($station) {
            $secret = bin2hex(random_bytes(16));
            $filepath = realpath(dirname(__file__).'/../..') . '/' . $envname;

            $editor = new DotenvEditor();
            if (file_exists($filepath)) {
                $editor->load($filepath);
                $io->note(sprintf('Editing file: %s', $filepath));
            } else {
                $io->note(sprintf('Creating file: %s', $filepath));
            }
            if (!$editor->has('APP_SECRET')) {
                $editor->set('APP_SECRET', $secret);
            }
            $editor->set('MYCALL', $station);
            if ($input->getOption('replies')) {
                $editor->set('REPLIES', 'true');
            } else {
                $editor->unset('REPLIES');
            }
            $editor->save($filepath);
        }

        $io->success(sprintf('Station %s setup', $station));

        return Command::SUCCESS;
    }
}
