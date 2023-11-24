<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814120224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gate_placement (id INT AUTO_INCREMENT NOT NULL, gate_id INT DEFAULT NULL, line INT NOT NULL, INDEX IDX_BCC6361897F2CF6 (gate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sun_design_gate (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gate_placement ADD CONSTRAINT FK_BCC6361897F2CF6 FOREIGN KEY (gate_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD sun_design_id INT DEFAULT NULL, ADD earth_design_id INT DEFAULT NULL, ADD north_node_design_id INT DEFAULT NULL, ADD south_node_design_id INT DEFAULT NULL, ADD moon_design_id INT DEFAULT NULL, ADD mercury_design_id INT DEFAULT NULL, ADD venus_design_id INT DEFAULT NULL, ADD mars_design_id INT DEFAULT NULL, ADD jupiter_design_id INT DEFAULT NULL, ADD saturn_design_id INT DEFAULT NULL, ADD uranus_design_id INT DEFAULT NULL, ADD neptune_design_id INT DEFAULT NULL, ADD pluto_design_id INT DEFAULT NULL, ADD sun_personality_id INT DEFAULT NULL, ADD earth_personality_id INT DEFAULT NULL, ADD north_node_personality_id INT DEFAULT NULL, ADD south_node_personality_id INT DEFAULT NULL, ADD moon_personality_id INT DEFAULT NULL, ADD mercury_personality_id INT DEFAULT NULL, ADD venus_personality_id INT DEFAULT NULL, ADD mars_personality_id INT DEFAULT NULL, ADD jupiter_personality_id INT DEFAULT NULL, ADD saturn_personality_id INT DEFAULT NULL, ADD uranus_personality_id INT DEFAULT NULL, ADD neptune_personality_id INT DEFAULT NULL, ADD pluto_personality_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD birthplace VARCHAR(255) NOT NULL, ADD birthdate DATE NOT NULL, ADD birthtime TIME NOT NULL');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784FC0A1DCB FOREIGN KEY (sun_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784EA409230 FOREIGN KEY (earth_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847460B703 FOREIGN KEY (north_node_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784C3D910EF FOREIGN KEY (south_node_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784D170C740 FOREIGN KEY (moon_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784150428AC FOREIGN KEY (mercury_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849E3CF8DC FOREIGN KEY (venus_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784DC43AE2E FOREIGN KEY (mars_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77842F375BC1 FOREIGN KEY (jupiter_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784351083F0 FOREIGN KEY (saturn_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778493BB3419 FOREIGN KEY (uranus_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77844099A264 FOREIGN KEY (neptune_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847E17D074 FOREIGN KEY (pluto_design_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849BB615C FOREIGN KEY (sun_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784E2F01BBC FOREIGN KEY (earth_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778444126792 FOREIGN KEY (north_node_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778418819110 FOREIGN KEY (south_node_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784FF280E4B FOREIGN KEY (moon_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784607EA73D FOREIGN KEY (mercury_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77844DF70BC3 FOREIGN KEY (venus_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784C875A6A FOREIGN KEY (mars_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847BD29E03 FOREIGN KEY (jupiter_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784895C34FD FOREIGN KEY (saturn_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778414D4E9E FOREIGN KEY (uranus_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849F8D0CA FOREIGN KEY (neptune_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778424002A8 FOREIGN KEY (pluto_personality_id) REFERENCES gate_placement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784FC0A1DCB ON report (sun_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784EA409230 ON report (earth_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77847460B703 ON report (north_node_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784C3D910EF ON report (south_node_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784D170C740 ON report (moon_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784150428AC ON report (mercury_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77849E3CF8DC ON report (venus_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784DC43AE2E ON report (mars_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77842F375BC1 ON report (jupiter_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784351083F0 ON report (saturn_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F778493BB3419 ON report (uranus_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77844099A264 ON report (neptune_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77847E17D074 ON report (pluto_design_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77849BB615C ON report (sun_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784E2F01BBC ON report (earth_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F778444126792 ON report (north_node_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F778418819110 ON report (south_node_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784FF280E4B ON report (moon_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784607EA73D ON report (mercury_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77844DF70BC3 ON report (venus_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784C875A6A ON report (mars_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77847BD29E03 ON report (jupiter_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F7784895C34FD ON report (saturn_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F778414D4E9E ON report (uranus_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F77849F8D0CA ON report (neptune_personality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C42F778424002A8 ON report (pluto_personality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784FC0A1DCB');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784EA409230');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847460B703');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784C3D910EF');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784D170C740');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784150428AC');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849E3CF8DC');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784DC43AE2E');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77842F375BC1');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784351083F0');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778493BB3419');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844099A264');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847E17D074');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849BB615C');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784E2F01BBC');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778444126792');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778418819110');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784FF280E4B');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784607EA73D');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844DF70BC3');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784C875A6A');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847BD29E03');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784895C34FD');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778414D4E9E');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849F8D0CA');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778424002A8');
        $this->addSql('ALTER TABLE gate_placement DROP FOREIGN KEY FK_BCC6361897F2CF6');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE gate_placement');
        $this->addSql('DROP TABLE sun_design_gate');
        $this->addSql('DROP INDEX UNIQ_C42F7784FC0A1DCB ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784EA409230 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77847460B703 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784C3D910EF ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784D170C740 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784150428AC ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77849E3CF8DC ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784DC43AE2E ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77842F375BC1 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784351083F0 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F778493BB3419 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77844099A264 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77847E17D074 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77849BB615C ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784E2F01BBC ON report');
        $this->addSql('DROP INDEX UNIQ_C42F778444126792 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F778418819110 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784FF280E4B ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784607EA73D ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77844DF70BC3 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784C875A6A ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77847BD29E03 ON report');
        $this->addSql('DROP INDEX UNIQ_C42F7784895C34FD ON report');
        $this->addSql('DROP INDEX UNIQ_C42F778414D4E9E ON report');
        $this->addSql('DROP INDEX UNIQ_C42F77849F8D0CA ON report');
        $this->addSql('DROP INDEX UNIQ_C42F778424002A8 ON report');
        $this->addSql('ALTER TABLE report DROP sun_design_id, DROP earth_design_id, DROP north_node_design_id, DROP south_node_design_id, DROP moon_design_id, DROP mercury_design_id, DROP venus_design_id, DROP mars_design_id, DROP jupiter_design_id, DROP saturn_design_id, DROP uranus_design_id, DROP neptune_design_id, DROP pluto_design_id, DROP sun_personality_id, DROP earth_personality_id, DROP north_node_personality_id, DROP south_node_personality_id, DROP moon_personality_id, DROP mercury_personality_id, DROP venus_personality_id, DROP mars_personality_id, DROP jupiter_personality_id, DROP saturn_personality_id, DROP uranus_personality_id, DROP neptune_personality_id, DROP pluto_personality_id, DROP name, DROP birthplace, DROP birthdate, DROP birthtime');
    }
}
