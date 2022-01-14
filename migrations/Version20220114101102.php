<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114101102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, bien_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, loyer INT NOT NULL, caution INT NOT NULL, avance INT DEFAULT NULL, duree INT NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_5E9E89CBBD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_user (location_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D97630964D218E (location_id), INDEX IDX_D976309A76ED395 (user_id), PRIMARY KEY(location_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBBD95B80F FOREIGN KEY (bien_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE location_user ADD CONSTRAINT FK_D97630964D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location_user ADD CONSTRAINT FK_D976309A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property DROP year_built, DROP type_property_id, CHANGE img_slide img_slide VARCHAR(255) NOT NULL, CHANGE in_slide in_slide TINYINT(1) NOT NULL, CHANGE statut_property_id statut_property_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE2D3B6045 FOREIGN KEY (statut_property_id) REFERENCES statut_property (id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE2D3B6045 ON property (statut_property_id)');
        $this->addSql('ALTER TABLE users CHANGE agence_id_id agence_id_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location_user DROP FOREIGN KEY FK_D97630964D218E');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_user');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE2D3B6045');
        $this->addSql('DROP INDEX IDX_8BF21CDE2D3B6045 ON property');
        $this->addSql('ALTER TABLE property ADD year_built DATE NOT NULL, ADD type_property_id INT DEFAULT NULL, CHANGE statut_property_id statut_property_id INT NOT NULL, CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE agence_id_id agence_id_id INT DEFAULT NULL');
    }
}
