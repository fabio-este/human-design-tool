<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816001807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate ADD original_title VARCHAR(255) NOT NULL, ADD line1 TINYINT(1) NOT NULL, ADD line2 TINYINT(1) NOT NULL, ADD line3 TINYINT(1) NOT NULL, ADD line4 TINYINT(1) NOT NULL, ADD line5 TINYINT(1) NOT NULL, ADD line6 TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate DROP original_title, DROP line1, DROP line2, DROP line3, DROP line4, DROP line5, DROP line6');
    }
}
