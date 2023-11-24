<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830210601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE channel_channel_properties (channel_id INT NOT NULL, channel_properties_id INT NOT NULL, INDEX IDX_5250875872F5A1AA (channel_id), INDEX IDX_52508758970C327E (channel_properties_id), PRIMARY KEY(channel_id, channel_properties_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE channel_properties (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE channel_channel_properties ADD CONSTRAINT FK_5250875872F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE channel_channel_properties ADD CONSTRAINT FK_52508758970C327E FOREIGN KEY (channel_properties_id) REFERENCES channel_properties (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE channel_channel_properties DROP FOREIGN KEY FK_5250875872F5A1AA');
        $this->addSql('ALTER TABLE channel_channel_properties DROP FOREIGN KEY FK_52508758970C327E');
        $this->addSql('DROP TABLE channel_channel_properties');
        $this->addSql('DROP TABLE channel_properties');
    }
}
