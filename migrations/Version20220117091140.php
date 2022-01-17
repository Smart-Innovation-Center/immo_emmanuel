<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220117091140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location CHANGE libelle libelle VARCHAR(255) NOT NULL, CHANGE loyer loyer INT NOT NULL, CHANGE caution caution INT NOT NULL');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) NOT NULL, CHANGE in_slide in_slide TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location CHANGE libelle libelle VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE loyer loyer INT DEFAULT NULL, CHANGE caution caution INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) DEFAULT NULL');
    }
}
