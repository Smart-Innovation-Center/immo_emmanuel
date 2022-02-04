<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129094822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD type_property_id INT DEFAULT NULL, CHANGE img_slide img_slide VARCHAR(255) NOT NULL, CHANGE in_slide in_slide TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE1F8BC47D FOREIGN KEY (type_property_id) REFERENCES type_property (id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE1F8BC47D ON property (type_property_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE1F8BC47D');
        $this->addSql('DROP INDEX IDX_8BF21CDE1F8BC47D ON property');
        $this->addSql('ALTER TABLE property DROP type_property_id, CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) DEFAULT NULL');
    }
}
