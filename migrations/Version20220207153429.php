<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207153429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) NOT NULL, CHANGE in_slide in_slide TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE transfer ADD type_tranfer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0CFFF8730 FOREIGN KEY (type_tranfer_id) REFERENCES type_transfer (id)');
        $this->addSql('CREATE INDEX IDX_4034A3C0CFFF8730 ON transfer (type_tranfer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property CHANGE img_slide img_slide VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_slide in_slide TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0CFFF8730');
        $this->addSql('DROP INDEX IDX_4034A3C0CFFF8730 ON transfer');
        $this->addSql('ALTER TABLE transfer DROP type_tranfer_id');
    }
}
