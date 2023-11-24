<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820123112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5D5CAD932');
        $this->addSql('DROP TABLE strategy');
        $this->addSql('DROP TABLE signature');
        $this->addSql('DROP TABLE sun_design_gate');
        $this->addSql('DROP TABLE subtitle');
        $this->addSql('DROP INDEX IDX_1E4C9A5D5CAD932 ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph DROP strategy_id');
        $this->addSql('ALTER TABLE incarnation_cross ADD sun_design_id INT DEFAULT NULL, ADD earth_design_id INT DEFAULT NULL, ADD sun_personality_id INT DEFAULT NULL, ADD earth_personality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E912FC0A1DCB FOREIGN KEY (sun_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E912EA409230 FOREIGN KEY (earth_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E9129BB615C FOREIGN KEY (sun_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE incarnation_cross ADD CONSTRAINT FK_BBB6E912E2F01BBC FOREIGN KEY (earth_personality_id) REFERENCES gate (id)');
        $this->addSql('CREATE INDEX IDX_BBB6E912FC0A1DCB ON incarnation_cross (sun_design_id)');
        $this->addSql('CREATE INDEX IDX_BBB6E912EA409230 ON incarnation_cross (earth_design_id)');
        $this->addSql('CREATE INDEX IDX_BBB6E9129BB615C ON incarnation_cross (sun_personality_id)');
        $this->addSql('CREATE INDEX IDX_BBB6E912E2F01BBC ON incarnation_cross (earth_personality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE strategy (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, identifier VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE signature (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, self LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, not_self LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, not_self_title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sun_design_gate (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE subtitle (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E912FC0A1DCB');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E912EA409230');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E9129BB615C');
        $this->addSql('ALTER TABLE incarnation_cross DROP FOREIGN KEY FK_BBB6E912E2F01BBC');
        $this->addSql('DROP INDEX IDX_BBB6E912FC0A1DCB ON incarnation_cross');
        $this->addSql('DROP INDEX IDX_BBB6E912EA409230 ON incarnation_cross');
        $this->addSql('DROP INDEX IDX_BBB6E9129BB615C ON incarnation_cross');
        $this->addSql('DROP INDEX IDX_BBB6E912E2F01BBC ON incarnation_cross');
        $this->addSql('ALTER TABLE incarnation_cross DROP sun_design_id, DROP earth_design_id, DROP sun_personality_id, DROP earth_personality_id');
        $this->addSql('ALTER TABLE bodygraph ADD strategy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5D5CAD932 FOREIGN KEY (strategy_id) REFERENCES strategy (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5D5CAD932 ON bodygraph (strategy_id)');
    }
}
