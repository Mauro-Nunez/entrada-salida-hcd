<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919013312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comision (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concejal (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE novedad ADD comision_id INT DEFAULT NULL, ADD concejal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE novedad ADD CONSTRAINT FK_BCCADB4C4B352BE1 FOREIGN KEY (comision_id) REFERENCES comision (id)');
        $this->addSql('ALTER TABLE novedad ADD CONSTRAINT FK_BCCADB4C74DBA65C FOREIGN KEY (concejal_id) REFERENCES concejal (id)');
        $this->addSql('CREATE INDEX IDX_BCCADB4C4B352BE1 ON novedad (comision_id)');
        $this->addSql('CREATE INDEX IDX_BCCADB4C74DBA65C ON novedad (concejal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE novedad DROP FOREIGN KEY FK_BCCADB4C4B352BE1');
        $this->addSql('ALTER TABLE novedad DROP FOREIGN KEY FK_BCCADB4C74DBA65C');
        $this->addSql('DROP TABLE comision');
        $this->addSql('DROP TABLE concejal');
        $this->addSql('DROP INDEX IDX_BCCADB4C4B352BE1 ON novedad');
        $this->addSql('DROP INDEX IDX_BCCADB4C74DBA65C ON novedad');
        $this->addSql('ALTER TABLE novedad DROP comision_id, DROP concejal_id');
    }
}
