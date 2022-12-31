<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221231001936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add App\Entity\Bulletin';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bulletin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, current_state VARCHAR(255) NOT NULL, datetime DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , content CLOB NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bulletin');
    }
}
