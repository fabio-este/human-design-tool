<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124004422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_penta (id INT AUTO_INCREMENT NOT NULL, presence INT NOT NULL, structure INT NOT NULL, execution INT NOT NULL, vigilence INT NOT NULL, analysis INT NOT NULL, focus INT NOT NULL, planning INT NOT NULL, capacity INT NOT NULL, culture INT NOT NULL, commitment INT NOT NULL, reliability INT NOT NULL, coordination INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_penta_bodygraph (team_penta_id INT NOT NULL, bodygraph_id INT NOT NULL, INDEX IDX_175E07228C8855A4 (team_penta_id), INDEX IDX_175E07224AD10DC (bodygraph_id), PRIMARY KEY(team_penta_id, bodygraph_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team_penta_bodygraph ADD CONSTRAINT FK_175E07228C8855A4 FOREIGN KEY (team_penta_id) REFERENCES team_penta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_penta_bodygraph ADD CONSTRAINT FK_175E07224AD10DC FOREIGN KEY (bodygraph_id) REFERENCES bodygraph (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bodygraph ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5A76ED395 ON bodygraph (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team_penta_bodygraph DROP FOREIGN KEY FK_175E07228C8855A4');
        $this->addSql('ALTER TABLE team_penta_bodygraph DROP FOREIGN KEY FK_175E07224AD10DC');
        $this->addSql('DROP TABLE team_penta');
        $this->addSql('DROP TABLE team_penta_bodygraph');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5A76ED395');
        $this->addSql('DROP INDEX IDX_1E4C9A5A76ED395 ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph DROP user_id');
    }
}
