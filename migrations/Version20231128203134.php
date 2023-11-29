<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128203134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph ADD chiron_design_id INT DEFAULT NULL, ADD chiron_personality_id INT DEFAULT NULL, ADD lilith_design_id INT DEFAULT NULL, ADD lilit_personality_id INT DEFAULT NULL, ADD part_of_fortune_design_id INT DEFAULT NULL, ADD part_of_fortune_personality_id INT DEFAULT NULL, ADD ascendant_personality_id INT DEFAULT NULL, ADD ascendant_design_id INT DEFAULT NULL, ADD midheaven_design_id INT DEFAULT NULL, ADD midheaven_personality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A59BC90C7C FOREIGN KEY (chiron_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5FAAC50DB FOREIGN KEY (chiron_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5EE8A440B FOREIGN KEY (lilith_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A560897265 FOREIGN KEY (lilit_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5B861EBAE FOREIGN KEY (part_of_fortune_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A52BF37EDA FOREIGN KEY (part_of_fortune_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A55E754EA2 FOREIGN KEY (ascendant_personality_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5A2506FB FOREIGN KEY (ascendant_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A551FAE149 FOREIGN KEY (midheaven_design_id) REFERENCES gate (id)');
        $this->addSql('ALTER TABLE bodygraph ADD CONSTRAINT FK_1E4C9A5A0409AC5 FOREIGN KEY (midheaven_personality_id) REFERENCES gate (id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A59BC90C7C ON bodygraph (chiron_design_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5FAAC50DB ON bodygraph (chiron_personality_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5EE8A440B ON bodygraph (lilith_design_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A560897265 ON bodygraph (lilit_personality_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5B861EBAE ON bodygraph (part_of_fortune_design_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A52BF37EDA ON bodygraph (part_of_fortune_personality_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A55E754EA2 ON bodygraph (ascendant_personality_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5A2506FB ON bodygraph (ascendant_design_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A551FAE149 ON bodygraph (midheaven_design_id)');
        $this->addSql('CREATE INDEX IDX_1E4C9A5A0409AC5 ON bodygraph (midheaven_personality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A59BC90C7C');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5FAAC50DB');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5EE8A440B');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A560897265');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5B861EBAE');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A52BF37EDA');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A55E754EA2');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5A2506FB');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A551FAE149');
        $this->addSql('ALTER TABLE bodygraph DROP FOREIGN KEY FK_1E4C9A5A0409AC5');
        $this->addSql('DROP INDEX IDX_1E4C9A59BC90C7C ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5FAAC50DB ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5EE8A440B ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A560897265 ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5B861EBAE ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A52BF37EDA ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A55E754EA2 ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5A2506FB ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A551FAE149 ON bodygraph');
        $this->addSql('DROP INDEX IDX_1E4C9A5A0409AC5 ON bodygraph');
        $this->addSql('ALTER TABLE bodygraph DROP chiron_design_id, DROP chiron_personality_id, DROP lilith_design_id, DROP lilit_personality_id, DROP part_of_fortune_design_id, DROP part_of_fortune_personality_id, DROP ascendant_personality_id, DROP ascendant_design_id, DROP midheaven_design_id, DROP midheaven_personality_id');
    }
}
