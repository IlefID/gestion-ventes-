<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503093953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appareil DROP CONSTRAINT fk_456a601ad34f45e1');
        $this->addSql('ALTER TABLE appareil DROP CONSTRAINT fk_456a601ae525855e');
        $this->addSql('DROP INDEX idx_456a601ae525855e');
        $this->addSql('DROP INDEX idx_456a601ad34f45e1');
        $this->addSql('ALTER TABLE appareil ADD idos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appareil ADD idfab_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appareil DROP id_os_id');
        $this->addSql('ALTER TABLE appareil DROP id_fab_id');
        $this->addSql('ALTER TABLE appareil DROP url_image');
        $this->addSql('ALTER TABLE appareil ADD CONSTRAINT FK_456A601AEBCF68C8 FOREIGN KEY (idos_id) REFERENCES systeme (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE appareil ADD CONSTRAINT FK_456A601AA7AF9D1F FOREIGN KEY (idfab_id) REFERENCES fabricant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_456A601AEBCF68C8 ON appareil (idos_id)');
        $this->addSql('CREATE INDEX IDX_456A601AA7AF9D1F ON appareil (idfab_id)');
        $this->addSql('ALTER TABLE fabricant DROP url_image');
        $this->addSql('ALTER TABLE fabricant ALTER nom TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE fabricant ALTER pays_origine TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE fabricant RENAME COLUMN id_fab TO idfab');
        $this->addSql('ALTER TABLE systeme DROP url_image');
        $this->addSql('ALTER TABLE systeme ALTER famille TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE systeme ALTER editeur TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE systeme RENAME COLUMN id_os TO idos');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE systeme ADD url_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE systeme ALTER famille TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE systeme ALTER editeur TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE systeme RENAME COLUMN idos TO id_os');
        $this->addSql('ALTER TABLE appareil DROP CONSTRAINT FK_456A601AEBCF68C8');
        $this->addSql('ALTER TABLE appareil DROP CONSTRAINT FK_456A601AA7AF9D1F');
        $this->addSql('DROP INDEX IDX_456A601AEBCF68C8');
        $this->addSql('DROP INDEX IDX_456A601AA7AF9D1F');
        $this->addSql('ALTER TABLE appareil ADD id_os_id INT NOT NULL');
        $this->addSql('ALTER TABLE appareil ADD id_fab_id INT NOT NULL');
        $this->addSql('ALTER TABLE appareil ADD url_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE appareil DROP idos_id');
        $this->addSql('ALTER TABLE appareil DROP idfab_id');
        $this->addSql('ALTER TABLE appareil ADD CONSTRAINT fk_456a601ad34f45e1 FOREIGN KEY (id_os_id) REFERENCES systeme (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE appareil ADD CONSTRAINT fk_456a601ae525855e FOREIGN KEY (id_fab_id) REFERENCES fabricant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_456a601ae525855e ON appareil (id_fab_id)');
        $this->addSql('CREATE INDEX idx_456a601ad34f45e1 ON appareil (id_os_id)');
        $this->addSql('ALTER TABLE fabricant ADD url_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fabricant ALTER nom TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE fabricant ALTER pays_origine TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE fabricant RENAME COLUMN idfab TO id_fab');
    }
}
