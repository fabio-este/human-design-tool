<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820100854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile ADD design_line_id INT DEFAULT NULL, ADD personality_line_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FD4D0E568 FOREIGN KEY (design_line_id) REFERENCES line (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F9C3655B3 FOREIGN KEY (personality_line_id) REFERENCES line (id)');
        $this->addSql('CREATE INDEX IDX_8157AA0FD4D0E568 ON profile (design_line_id)');
        $this->addSql('CREATE INDEX IDX_8157AA0F9C3655B3 ON profile (personality_line_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FD4D0E568');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F9C3655B3');
        $this->addSql('DROP INDEX IDX_8157AA0FD4D0E568 ON profile');
        $this->addSql('DROP INDEX IDX_8157AA0F9C3655B3 ON profile');
        $this->addSql('ALTER TABLE profile DROP design_line_id, DROP personality_line_id');
    }
}
