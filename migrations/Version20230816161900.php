<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816161900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bodygraph_channel (bodygraph_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_DD2C2CAE4AD10DC (bodygraph_id), INDEX IDX_DD2C2CAE72F5A1AA (channel_id), PRIMARY KEY(bodygraph_id, channel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bodygraph_channel ADD CONSTRAINT FK_DD2C2CAE4AD10DC FOREIGN KEY (bodygraph_id) REFERENCES bodygraph (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bodygraph_channel ADD CONSTRAINT FK_DD2C2CAE72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph_channel DROP FOREIGN KEY FK_DD2C2CAE4AD10DC');
        $this->addSql('ALTER TABLE bodygraph_channel DROP FOREIGN KEY FK_DD2C2CAE72F5A1AA');
        $this->addSql('DROP TABLE bodygraph_channel');
    }
}
