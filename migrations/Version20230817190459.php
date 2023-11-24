<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230817190459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A52AD56A7C');
        $this->addSql('DROP INDEX IDX_1E4C9A52AD56A7C ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph ADD aura_type VARCHAR(255) NOT NULL, DROP aura_type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD aura_type_id INT DEFAULT NULL, DROP aura_type');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A52AD56A7C FOREIGN KEY (aura_type_id) REFERENCES aura_type (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A52AD56A7C ON bodygraph (aura_type_id)');
    }
}
