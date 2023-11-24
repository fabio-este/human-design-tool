<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822125030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE incarnation_cross_gate DROP FOREIGN KEY FK_92BBD70ED45DEC89');
        $this->addSql('ALTER TABLE incarnation_cross_gate DROP FOREIGN KEY FK_92BBD70E897F2CF6');
        $this->addSql('DROP TABLE incarnation_cross_gate');
        $this->addSql('ALTER TABLE incarnation_cross ADD title VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE incarnation_cross_gate (incarnation_cross_id INT NOT NULL, gate_id INT NOT NULL, INDEX IDX_92BBD70E897F2CF6 (gate_id), INDEX IDX_92BBD70ED45DEC89 (incarnation_cross_id), PRIMARY KEY(incarnation_cross_id, gate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE incarnation_cross_gate ADD CONSTRAINT FK_92BBD70ED45DEC89 FOREIGN KEY (incarnation_cross_id) REFERENCES incarnation_cross (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnation_cross_gate ADD CONSTRAINT FK_92BBD70E897F2CF6 FOREIGN KEY (gate_id) REFERENCES gate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incarnation_cross DROP title');
    }
}
