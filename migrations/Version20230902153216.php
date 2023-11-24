<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902153216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate_activation ADD bodygraph_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gate_activation ADD CONSTRAINT FK_C1260BA84AD10DC FOREIGN KEY (bodygraph_id) REFERENCES bodygraph (id)');
        $this->addSql('CREATE INDEX IDX_C1260BA84AD10DC ON gate_activation (bodygraph_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate_activation DROP FOREIGN KEY FK_C1260BA84AD10DC');
        $this->addSql('DROP INDEX IDX_C1260BA84AD10DC ON gate_activation');
        $this->addSql('ALTER TABLE gate_activation DROP bodygraph_id');
    }
}
