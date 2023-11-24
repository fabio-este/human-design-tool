<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230823192658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5895C34FD, ADD INDEX IDX_1E4C9A5895C34FD (saturn_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A59E3CF8DC, ADD INDEX IDX_1E4C9A59E3CF8DC (venus_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A54DF70BC3, ADD INDEX IDX_1E4C9A54DF70BC3 (venus_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5C3D910EF, ADD INDEX IDX_1E4C9A5C3D910EF (south_node_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A518819110, ADD INDEX IDX_1E4C9A518819110 (south_node_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5FC0A1DCB, ADD INDEX IDX_1E4C9A5FC0A1DCB (sun_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A59BB615C, ADD INDEX IDX_1E4C9A59BB615C (sun_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A593BB3419, ADD INDEX IDX_1E4C9A593BB3419 (uranus_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A514D4E9E, ADD INDEX IDX_1E4C9A514D4E9E (uranus_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5DC43AE2E, ADD INDEX IDX_1E4C9A5DC43AE2E (mars_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5C875A6A, ADD INDEX IDX_1E4C9A5C875A6A (mars_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5D170C740, ADD INDEX IDX_1E4C9A5D170C740 (moon_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5FF280E4B, ADD INDEX IDX_1E4C9A5FF280E4B (moon_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5EA409230, ADD INDEX IDX_1E4C9A5EA409230 (earth_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5E2F01BBC, ADD INDEX IDX_1E4C9A5E2F01BBC (earth_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A54099A264, ADD INDEX IDX_1E4C9A54099A264 (neptune_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A52F375BC1, ADD INDEX IDX_1E4C9A52F375BC1 (jupiter_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A59F8D0CA, ADD INDEX IDX_1E4C9A59F8D0CA (neptune_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A57BD29E03, ADD INDEX IDX_1E4C9A57BD29E03 (jupiter_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5150428AC, ADD INDEX IDX_1E4C9A5150428AC (mercury_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5607EA73D, ADD INDEX IDX_1E4C9A5607EA73D (mercury_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A57460B703, ADD INDEX IDX_1E4C9A57460B703 (north_node_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A544126792, ADD INDEX IDX_1E4C9A544126792 (north_node_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A57E17D074, ADD INDEX IDX_1E4C9A57E17D074 (pluto_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A5351083F0, ADD INDEX IDX_1E4C9A5351083F0 (saturn_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX UNIQ_1E4C9A524002A8, ADD INDEX IDX_1E4C9A524002A8 (pluto_personality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5FC0A1DCB, ADD UNIQUE INDEX UNIQ_1E4C9A5FC0A1DCB (sun_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5EA409230, ADD UNIQUE INDEX UNIQ_1E4C9A5EA409230 (earth_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A57460B703, ADD UNIQUE INDEX UNIQ_1E4C9A57460B703 (north_node_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5C3D910EF, ADD UNIQUE INDEX UNIQ_1E4C9A5C3D910EF (south_node_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5D170C740, ADD UNIQUE INDEX UNIQ_1E4C9A5D170C740 (moon_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5150428AC, ADD UNIQUE INDEX UNIQ_1E4C9A5150428AC (mercury_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A59E3CF8DC, ADD UNIQUE INDEX UNIQ_1E4C9A59E3CF8DC (venus_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5DC43AE2E, ADD UNIQUE INDEX UNIQ_1E4C9A5DC43AE2E (mars_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A52F375BC1, ADD UNIQUE INDEX UNIQ_1E4C9A52F375BC1 (jupiter_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5351083F0, ADD UNIQUE INDEX UNIQ_1E4C9A5351083F0 (saturn_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A593BB3419, ADD UNIQUE INDEX UNIQ_1E4C9A593BB3419 (uranus_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A54099A264, ADD UNIQUE INDEX UNIQ_1E4C9A54099A264 (neptune_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A57E17D074, ADD UNIQUE INDEX UNIQ_1E4C9A57E17D074 (pluto_design_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A59BB615C, ADD UNIQUE INDEX UNIQ_1E4C9A59BB615C (sun_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5E2F01BBC, ADD UNIQUE INDEX UNIQ_1E4C9A5E2F01BBC (earth_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A544126792, ADD UNIQUE INDEX UNIQ_1E4C9A544126792 (north_node_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A518819110, ADD UNIQUE INDEX UNIQ_1E4C9A518819110 (south_node_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5FF280E4B, ADD UNIQUE INDEX UNIQ_1E4C9A5FF280E4B (moon_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5607EA73D, ADD UNIQUE INDEX UNIQ_1E4C9A5607EA73D (mercury_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A54DF70BC3, ADD UNIQUE INDEX UNIQ_1E4C9A54DF70BC3 (venus_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5C875A6A, ADD UNIQUE INDEX UNIQ_1E4C9A5C875A6A (mars_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A57BD29E03, ADD UNIQUE INDEX UNIQ_1E4C9A57BD29E03 (jupiter_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A5895C34FD, ADD UNIQUE INDEX UNIQ_1E4C9A5895C34FD (saturn_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A514D4E9E, ADD UNIQUE INDEX UNIQ_1E4C9A514D4E9E (uranus_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A59F8D0CA, ADD UNIQUE INDEX UNIQ_1E4C9A59F8D0CA (neptune_personality_id)');
        $this->addSql('ALTER TABLE bodygraph DROP INDEX IDX_1E4C9A524002A8, ADD UNIQUE INDEX UNIQ_1E4C9A524002A8 (pluto_personality_id)');
    }
}
