<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816215645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE center_status (id INT AUTO_INCREMENT NOT NULL, center_id INT DEFAULT NULL, bodygraph_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_16627C315932F377 (center_id), INDEX IDX_16627C314AD10DC (bodygraph_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE center_status ADD CONSTRAINT FK_16627C315932F377 FOREIGN KEY (center_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE center_status ADD CONSTRAINT FK_16627C314AD10DC FOREIGN KEY (bodygraph_id) REFERENCES bodygraph (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE center_status DROP FOREIGN KEY FK_16627C315932F377');
        $this->addSql('ALTER TABLE center_status DROP FOREIGN KEY FK_16627C314AD10DC');
        $this->addSql('DROP TABLE center_status');
    }
}
