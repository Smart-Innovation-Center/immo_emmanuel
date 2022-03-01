<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301134850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences ADD documents VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) NOT NULL, CHANGE in_slide in_slide TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences DROP documents');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) DEFAULT NULL');
    }
}
