<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114121744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD libelle VARCHAR(255) , ADD loyer INT , ADD caution INT , ADD avance INT ');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) , CHANGE in_slide in_slide TINYINT(1) ');
        $this->addSql('DROP INDEX IDX_1483A5E964D218E ON users');
        $this->addSql('ALTER TABLE users DROP location_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP libelle, DROP loyer, DROP caution, DROP avance');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) ');
        $this->addSql('ALTER TABLE users ADD location_id INT ');
        $this->addSql('CREATE INDEX IDX_1483A5E964D218E ON users (location_id)');
    }
}