<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'emcomm:user:reset',
    description: 'Resets a user password',
)]
class ResetUserCommand extends Command
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('password', InputArgument::OPTIONAL, 'The password for the user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $passwd = $input->getArgument('password');

        $user = $this->userRepository->findOneBy(['username' => $username]);
        if (!$user)
        {
            $io->error(sprintf('User with this username does not exist'));

            return Command::FAILURE;
        }

        if (!$passwd) {
            $passwd = $this->randomPassword();
            $io->note(sprintf('Generated password: %s', $passwd));
        }

        $this->userRepository->upgradePassword($user, $this->passwordHasher->hashPassword($user, $passwd));

        $io->success(sprintf('Reset admin user [%s]', $username));

        return Command::SUCCESS;
    }

    private function randomPassword(int $length = 10): string
    {
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($permitted_chars), 0, $length);
    }
}
