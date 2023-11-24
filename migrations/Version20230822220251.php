<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822220251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE channel_center (channel_id INT NOT NULL, center_id INT NOT NULL, INDEX IDX_BE93D15A72F5A1AA (channel_id), INDEX IDX_BE93D15A5932F377 (center_id), PRIMARY KEY(channel_id, center_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE channel_center ADD CONSTRAINT FK_BE93D15A72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE channel_center ADD CONSTRAINT FK_BE93D15A5932F377 FOREIGN KEY (center_id) REFERENCES center (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE channel_center DROP FOREIGN KEY FK_BE93D15A72F5A1AA');
        $this->addSql('ALTER TABLE channel_center DROP FOREIGN KEY FK_BE93D15A5932F377');
        $this->addSql('DROP TABLE channel_center');
    }
}
