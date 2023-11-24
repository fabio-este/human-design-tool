<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814190746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gate_gate (gate_source INT NOT NULL, gate_target INT NOT NULL, INDEX IDX_A1782DA522DC2691 (gate_source), INDEX IDX_A1782DA53B39761E (gate_target), PRIMARY KEY(gate_source, gate_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gate_gate ADD CONSTRAINT FK_A1782DA522DC2691 FOREIGN KEY (gate_source) REFERENCES gate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gate_gate ADD CONSTRAINT FK_A1782DA53B39761E FOREIGN KEY (gate_target) REFERENCES gate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784351083F0');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844DF70BC3');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847BD29E03');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778493BB3419');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849F8D0CA');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784D170C740');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784EA409230');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778414D4E9E');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778424002A8');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77844099A264');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784607EA73D');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847E17D074');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849BB615C');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784C3D910EF');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784DC43AE2E');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784FC0A1DCB');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784150428AC');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77842F375BC1');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778444126792');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77847460B703');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784895C34FD');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F77849E3CF8DC');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784C875A6A');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784E2F01BBC');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784FF280E4B');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778418819110');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784351083F0 FOREIGN KEY (saturn_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77844DF70BC3 FOREIGN KEY (venus_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847BD29E03 FOREIGN KEY (jupiter_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778493BB3419 FOREIGN KEY (uranus_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849F8D0CA FOREIGN KEY (neptune_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784D170C740 FOREIGN KEY (moon_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784EA409230 FOREIGN KEY (earth_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778414D4E9E FOREIGN KEY (uranus_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778424002A8 FOREIGN KEY (pluto_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77844099A264 FOREIGN KEY (neptune_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784607EA73D FOREIGN KEY (mercury_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847E17D074 FOREIGN KEY (pluto_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849BB615C FOREIGN KEY (sun_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784C3D910EF FOREIGN KEY (south_node_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784DC43AE2E FOREIGN KEY (mars_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784FC0A1DCB FOREIGN KEY (sun_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784150428AC FOREIGN KEY (mercury_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77842F375BC1 FOREIGN KEY (jupiter_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778444126792 FOREIGN KEY (north_node_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77847460B703 FOREIGN KEY (north_node_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784895C34FD FOREIGN KEY (saturn_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F77849E3CF8DC FOREIGN KEY (venus_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784C875A6A FOREIGN KEY (mars_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784E2F01BBC FOREIGN KEY (earth_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784FF280E4B FOREIGN KEY (moon_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778418819110 FOREIGN KEY (south_node_personality_id) REFERENCES gate (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gate_gate DROP FOREIGN KEY FK_A1782DA522DC2691');
        $this->addSql('ALTER TABLE gate_gate DROP FOREIGN KEY FK_A1782DA53B39761E');
        $this->addSql('DROP TABLE gate_gate');
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
    }
}
