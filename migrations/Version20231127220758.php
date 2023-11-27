<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127220758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate ADD degree_from_sign_id INT DEFAULT NULL, ADD degree_to_sign_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gate ADD CONSTRAINT FK_B82B9894FC26EB84 FOREIGN KEY (degree_from_sign_id) REFERENCES zodiac_sign (id)');
        $this->addSql('ALTER TABLE gate ADD CONSTRAINT FK_B82B98947BA19EDD FOREIGN KEY (degree_to_sign_id) REFERENCES zodiac_sign (id)');
        $this->addSql('CREATE INDEX IDX_B82B9894FC26EB84 ON gate (degree_from_sign_id)');
        $this->addSql('CREATE INDEX IDX_B82B98947BA19EDD ON gate (degree_to_sign_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate DROP FOREIGN KEY FK_B82B9894FC26EB84');
        $this->addSql('ALTER TABLE gate DROP FOREIGN KEY FK_B82B98947BA19EDD');
        $this->addSql('DROP INDEX IDX_B82B9894FC26EB84 ON gate');
        $this->addSql('DROP INDEX IDX_B82B98947BA19EDD ON gate');
        $this->addSql('ALTER TABLE gate DROP degree_from_sign_id, DROP degree_to_sign_id');
    }
}
