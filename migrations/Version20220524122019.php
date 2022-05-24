<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524122019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE novedad DROP FOREIGN KEY FK_BCCADB4CA9276E6C');
        $this->addSql('DROP INDEX IDX_BCCADB4CA9276E6C ON novedad');
        $this->addSql('ALTER TABLE novedad ADD nombre VARCHAR(50) NOT NULL, ADD egreso DATETIME DEFAULT NULL, DROP tipo_id, CHANGE fecha fecha DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE novedad ADD tipo_id INT NOT NULL, DROP nombre, DROP egreso, CHANGE fecha fecha DATETIME NOT NULL');
        $this->addSql('ALTER TABLE novedad ADD CONSTRAINT FK_BCCADB4CA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BCCADB4CA9276E6C ON novedad (tipo_id)');
    }
}
