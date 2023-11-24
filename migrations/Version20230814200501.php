<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814200501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE center_gate (center_id INT NOT NULL, gate_id INT NOT NULL, INDEX IDX_958C9BA75932F377 (center_id), INDEX IDX_958C9BA7897F2CF6 (gate_id), PRIMARY KEY(center_id, gate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE center_gate ADD CONSTRAINT FK_958C9BA75932F377 FOREIGN KEY (center_id) REFERENCES center (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE center_gate ADD CONSTRAINT FK_958C9BA7897F2CF6 FOREIGN KEY (gate_id) REFERENCES gate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gate DROP FOREIGN KEY FK_B82B98945932F377');
        $this->addSql('DROP INDEX IDX_B82B98945932F377 ON gate');
        $this->addSql('ALTER TABLE gate DROP center_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE center_gate DROP FOREIGN KEY FK_958C9BA75932F377');
        $this->addSql('ALTER TABLE center_gate DROP FOREIGN KEY FK_958C9BA7897F2CF6');
        $this->addSql('DROP TABLE center_gate');
        $this->addSql('ALTER TABLE gate ADD center_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gate ADD CONSTRAINT FK_B82B98945932F377 FOREIGN KEY (center_id) REFERENCES center (id)');
        $this->addSql('CREATE INDEX IDX_B82B98945932F377 ON gate (center_id)');
    }
}
