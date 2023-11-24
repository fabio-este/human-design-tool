<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902152342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate_placement ADD celestial_body_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gate_placement ADD CONSTRAINT FK_BCC6361A0AC9CF7 FOREIGN KEY (celestial_body_id) REFERENCES celestial_body (id)');
        $this->addSql('CREATE INDEX IDX_BCC6361A0AC9CF7 ON gate_placement (celestial_body_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate_placement DROP FOREIGN KEY FK_BCC6361A0AC9CF7');
        $this->addSql('DROP INDEX IDX_BCC6361A0AC9CF7 ON gate_placement');
        $this->addSql('ALTER TABLE gate_placement DROP celestial_body_id');
    }
}
