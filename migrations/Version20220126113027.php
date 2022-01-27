<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126113027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD recorder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB77549ADA FOREIGN KEY (recorder_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB77549ADA ON location (recorder_id)');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) NOT NULL, CHANGE in_slide in_slide TINYINT(1) NOT NULL');
        $this->addSql(' ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB77549ADA');
        $this->addSql('DROP INDEX IDX_5E9E89CB77549ADA ON location');
        $this->addSql('ALTER TABLE location DROP recorder_id');
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE agence_id_id agence_id_id INT NOT NULL');
    }
}