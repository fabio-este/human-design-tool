<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230818102034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD authority_id INT DEFAULT NULL, ADD profile_id INT DEFAULT NULL, ADD incarnation_cross_id INT DEFAULT NULL, ADD strategy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A581EC865B FOREIGN KEY (authority_id) REFERENCES authority (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5D45DEC89 FOREIGN KEY (incarnation_cross_id) REFERENCES incarnation_cross (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5D5CAD932 FOREIGN KEY (strategy_id) REFERENCES strategy (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A581EC865B ON bodygraph (authority_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5CCFA12B8 ON bodygraph (profile_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5D45DEC89 ON bodygraph (incarnation_cross_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5D5CAD932 ON bodygraph (strategy_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A581EC865B');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5CCFA12B8');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5D45DEC89');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5D5CAD932');
        $this->addSql('DROP INDEX IDX_1E4C9A581EC865B ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5CCFA12B8 ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5D45DEC89 ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5D5CAD932 ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph DROP authority_id, DROP profile_id, DROP incarnation_cross_id, DROP strategy_id');
    }
}
