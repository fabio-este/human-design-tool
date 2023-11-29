<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129003746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A560897265');
        $this->addSql('DROP INDEX IDX_1E4C9A560897265 ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph CHANGE lilit_personality_id lilith_personality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5CF6AA2FC FOREIGN KEY (lilith_personality_id) REFERENCES gate (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5CF6AA2FC ON bodygraph (lilith_personality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5CF6AA2FC');
        $this->addSql('DROP INDEX IDX_1E4C9A5CF6AA2FC ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph CHANGE lilith_personality_id lilit_personality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A560897265 FOREIGN KEY (lilit_personality_id) REFERENCES gate (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A560897265 ON bodygraph (lilit_personality_id)');
    }
}
