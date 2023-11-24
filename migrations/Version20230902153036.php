<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902153036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gate_activation (id INT AUTO_INCREMENT NOT NULL, celestial_body_id INT NOT NULL, line_id INT DEFAULT NULL, gate_id INT NOT NULL, mode VARCHAR(255) NOT NULL, INDEX IDX_C1260BA8A0AC9CF7 (celestial_body_id), INDEX IDX_C1260BA84D7B7542 (line_id), INDEX IDX_C1260BA8897F2CF6 (gate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gate_activation ADD CONSTRAINT FK_C1260BA8A0AC9CF7 FOREIGN KEY (celestial_body_id) REFERENCES celestial_body (id)');
        $this->addSql('ALTER TABLE gate_activation ADD CONSTRAINT FK_C1260BA84D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
        $this->addSql('ALTER TABLE gate_activation ADD CONSTRAINT FK_C1260BA8897F2CF6 FOREIGN KEY (gate_id) REFERENCES gate (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate_activation DROP FOREIGN KEY FK_C1260BA8A0AC9CF7');
        $this->addSql('ALTER TABLE gate_activation DROP FOREIGN KEY FK_C1260BA84D7B7542');
        $this->addSql('ALTER TABLE gate_activation DROP FOREIGN KEY FK_C1260BA8897F2CF6');
        $this->addSql('DROP TABLE gate_activation');
    }
}
