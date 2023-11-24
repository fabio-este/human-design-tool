<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814191648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE report_tag (report_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F372CF044BD2A4C0 (report_id), INDEX IDX_F372CF04BAD26311 (tag_id), PRIMARY KEY(report_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE report_tag ADD CONSTRAINT FK_F372CF044BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE report_tag ADD CONSTRAINT FK_F372CF04BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report_tag DROP FOREIGN KEY FK_F372CF044BD2A4C0');
        $this->addSql('ALTER TABLE report_tag DROP FOREIGN KEY FK_F372CF04BAD26311');
        $this->addSql('DROP TABLE report_tag');
    }
}
