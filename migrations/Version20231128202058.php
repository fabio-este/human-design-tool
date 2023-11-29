<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128202058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5FAAC50DB');
        $this->addSql('DROP INDEX FK_1E4C9A5FAAC50DB ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph ADD personality_api_response JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', ADD design_api_response JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', DROP chiron_personality_id, DROP chiron_design_id, DROP lilith_personality_id, DROP lilith_design_id, DROP part_of_fortune_personality_id, DROP part_of_fortune_design_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD chiron_personality_id INT DEFAULT NULL, ADD chiron_design_id INT NOT NULL, ADD lilith_personality_id INT DEFAULT NULL, ADD lilith_design_id INT DEFAULT NULL, ADD part_of_fortune_personality_id INT DEFAULT NULL, ADD part_of_fortune_design_id INT DEFAULT NULL, DROP personality_api_response, DROP design_api_response');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5FAAC50DB FOREIGN KEY (chiron_personality_id) REFERENCES gate (id)');
        $this->addSql('CREATE INDEX FK_1E4C9A5FAAC50DB ON bodygraph (chiron_personality_id)');
    }
}
