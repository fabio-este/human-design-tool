<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814200316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE center CHANGE description description LONGTEXT DEFAULT NULL, CHANGE not_self not_self LONGTEXT DEFAULT NULL, CHANGE description_open description_open LONGTEXT DEFAULT NULL, CHANGE description_undefined description_undefined LONGTEXT DEFAULT NULL, CHANGE description_defined description_defined LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE center CHANGE description description LONGTEXT NOT NULL, CHANGE not_self not_self LONGTEXT NOT NULL, CHANGE description_open description_open LONGTEXT NOT NULL, CHANGE description_undefined description_undefined LONGTEXT NOT NULL, CHANGE description_defined description_defined LONGTEXT NOT NULL');
    }
}
