<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118172528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences ADD structure_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agences ADD CONSTRAINT FK_B46015DDAA95C5C1 FOREIGN KEY (structure_id_id) REFERENCES structures (id)');
        $this->addSql('CREATE INDEX IDX_B46015DDAA95C5C1 ON agences (structure_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences DROP FOREIGN KEY FK_B46015DDAA95C5C1');
        $this->addSql('DROP INDEX IDX_B46015DDAA95C5C1 ON agences');
        $this->addSql('ALTER TABLE agences DROP structure_id_id');
    }
}
