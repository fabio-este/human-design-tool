<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816215335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bodygraph_channel (bodygraph_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_DD2C2CAE4AD10DC (bodygraph_id), INDEX IDX_DD2C2CAE72F5A1AA (channel_id), PRIMARY KEY(bodygraph_id, channel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE center_status (id INT AUTO_INCREMENT NOT NULL, center_id INT DEFAULT NULL, bodygraph_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_16627C315932F377 (center_id), INDEX IDX_16627C314AD10DC (bodygraph_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bodygraph_channel ADD CONSTRAINT FK_DD2C2CAE4AD10DC FOREIGN KEY (bodygraph_id) REFERENCES bodygraph (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bodygraph_channel ADD CONSTRAINT FK_DD2C2CAE72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE center_status ADD CONSTRAINT FK_16627C315932F377 FOREIGN KEY (center_id) REFERENCES center (id)');
        $this->addSql('ALTER TABLE center_status ADD CONSTRAINT FK_16627C314AD10DC FOREIGN KEY (bodygraph_id) REFERENCES bodygraph (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph_channel DROP FOREIGN KEY FK_DD2C2CAE4AD10DC');
        $this->addSql('ALTER TABLE bodygraph_channel DROP FOREIGN KEY FK_DD2C2CAE72F5A1AA');
        $this->addSql('ALTER TABLE center_status DROP FOREIGN KEY FK_16627C315932F377');
        $this->addSql('ALTER TABLE center_status DROP FOREIGN KEY FK_16627C314AD10DC');
        $this->addSql('DROP TABLE bodygraph_channel');
        $this->addSql('DROP TABLE center_status');
    }
}
