<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119122855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD public TINYINT(1) NOT NULL, CHANGE sun_design_line sun_design_line INT DEFAULT NULL, CHANGE earth_design_line earth_design_line INT DEFAULT NULL, CHANGE north_node_design_line north_node_design_line INT DEFAULT NULL, CHANGE south_node_design_line south_node_design_line INT DEFAULT NULL, CHANGE moon_design_line moon_design_line INT DEFAULT NULL, CHANGE mercury_design_line mercury_design_line INT DEFAULT NULL, CHANGE venus_design_line venus_design_line INT DEFAULT NULL, CHANGE mars_design_line mars_design_line INT DEFAULT NULL, CHANGE jupiter_design_line jupiter_design_line INT DEFAULT NULL, CHANGE saturn_design_line saturn_design_line INT DEFAULT NULL, CHANGE uranus_design_line uranus_design_line INT DEFAULT NULL, CHANGE neptune_design_line neptune_design_line INT DEFAULT NULL, CHANGE pluto_design_line pluto_design_line INT DEFAULT NULL, CHANGE sun_personality_line sun_personality_line INT DEFAULT NULL, CHANGE earth_personality_line earth_personality_line INT DEFAULT NULL, CHANGE north_node_personality_line north_node_personality_line INT DEFAULT NULL, CHANGE south_node_personality_line south_node_personality_line INT DEFAULT NULL, CHANGE moon_personality_line moon_personality_line INT DEFAULT NULL, CHANGE mercury_personality_line mercury_personality_line INT DEFAULT NULL, CHANGE venus_personality_line venus_personality_line INT DEFAULT NULL, CHANGE mars_personality_line mars_personality_line INT DEFAULT NULL, CHANGE jupiter_personality_line jupiter_personality_line INT DEFAULT NULL, CHANGE saturn_personality_line saturn_personality_line INT DEFAULT NULL, CHANGE uranus_personality_line uranus_personality_line INT DEFAULT NULL, CHANGE neptune_personality_line neptune_personality_line INT DEFAULT NULL, CHANGE pluto_personality_line pluto_personality_line INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP public, CHANGE sun_design_line sun_design_line INT NOT NULL, CHANGE earth_design_line earth_design_line INT NOT NULL, CHANGE north_node_design_line north_node_design_line INT NOT NULL, CHANGE south_node_design_line south_node_design_line INT NOT NULL, CHANGE moon_design_line moon_design_line INT NOT NULL, CHANGE mercury_design_line mercury_design_line INT NOT NULL, CHANGE venus_design_line venus_design_line INT NOT NULL, CHANGE mars_design_line mars_design_line INT NOT NULL, CHANGE jupiter_design_line jupiter_design_line INT NOT NULL, CHANGE saturn_design_line saturn_design_line INT NOT NULL, CHANGE uranus_design_line uranus_design_line INT NOT NULL, CHANGE neptune_design_line neptune_design_line INT NOT NULL, CHANGE pluto_design_line pluto_design_line INT NOT NULL, CHANGE sun_personality_line sun_personality_line INT NOT NULL, CHANGE earth_personality_line earth_personality_line INT NOT NULL, CHANGE north_node_personality_line north_node_personality_line INT NOT NULL, CHANGE south_node_personality_line south_node_personality_line INT NOT NULL, CHANGE moon_personality_line moon_personality_line INT NOT NULL, CHANGE mercury_personality_line mercury_personality_line INT NOT NULL, CHANGE venus_personality_line venus_personality_line INT NOT NULL, CHANGE mars_personality_line mars_personality_line INT NOT NULL, CHANGE jupiter_personality_line jupiter_personality_line INT NOT NULL, CHANGE saturn_personality_line saturn_personality_line INT NOT NULL, CHANGE uranus_personality_line uranus_personality_line INT NOT NULL, CHANGE neptune_personality_line neptune_personality_line INT NOT NULL, CHANGE pluto_personality_line pluto_personality_line INT NOT NULL');
    }
}
