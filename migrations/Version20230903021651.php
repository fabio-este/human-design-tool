<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230903021651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD sun_design_line INT NOT NULL, ADD earth_design_line INT NOT NULL, ADD north_node_design_line INT NOT NULL, ADD south_node_design_line INT NOT NULL, ADD moon_design_line INT NOT NULL, ADD mercury_design_line INT NOT NULL, ADD venus_design_line INT NOT NULL, ADD mars_design_line INT NOT NULL, ADD jupiter_design_line INT NOT NULL, ADD saturn_design_line INT NOT NULL, ADD uranus_design_line INT NOT NULL, ADD neptune_design_line INT NOT NULL, ADD pluto_design_line INT NOT NULL, ADD sun_personality_line INT NOT NULL, ADD earth_personality_line INT NOT NULL, ADD north_node_personality_line INT NOT NULL, ADD south_node_personality_line INT NOT NULL, ADD moon_personality_line INT NOT NULL, ADD mercury_personality_line INT NOT NULL, ADD venus_personality_line INT NOT NULL, ADD mars_personality_line INT NOT NULL, ADD jupiter_personality_line INT NOT NULL, ADD saturn_personality_line INT NOT NULL, ADD uranus_personality_line INT NOT NULL, ADD neptune_personality_line INT NOT NULL, ADD pluto_personality_line INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP sun_design_line, DROP earth_design_line, DROP north_node_design_line, DROP south_node_design_line, DROP moon_design_line, DROP mercury_design_line, DROP venus_design_line, DROP mars_design_line, DROP jupiter_design_line, DROP saturn_design_line, DROP uranus_design_line, DROP neptune_design_line, DROP pluto_design_line, DROP sun_personality_line, DROP earth_personality_line, DROP north_node_personality_line, DROP south_node_personality_line, DROP moon_personality_line, DROP mercury_personality_line, DROP venus_personality_line, DROP mars_personality_line, DROP jupiter_personality_line, DROP saturn_personality_line, DROP uranus_personality_line, DROP neptune_personality_line, DROP pluto_personality_line');
    }
}
