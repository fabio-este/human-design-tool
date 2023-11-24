<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830113315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5D45DEC89 FOREIGN KEY (incarnation_cross_id) REFERENCES incarnation_cross (id)');
        $this->addSql('ALTER TABLE gate ADD unicode VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E912FC0A1DCB FOREIGN KEY (sun_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E912EA409230 FOREIGN KEY (earth_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E9129BB615C FOREIGN KEY (sun_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E912E2F01BBC FOREIGN KEY (earth_personality_id) REFERENCES gate (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E912FC0A1DCB');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E912EA409230');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E9129BB615C');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E912E2F01BBC');
        $this->addSql('ALTER TABLE gate DROP unicode');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5D45DEC89');
    }
}
