<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510142033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asistencia (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, entrada TINYINT(1) NOT NULL, fecha DATETIME NOT NULL, INDEX IDX_D8264A8DDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE novedad (id INT AUTO_INCREMENT NOT NULL, tipo_id INT NOT NULL, dni INT NOT NULL, patente VARCHAR(10) DEFAULT NULL, fecha DATETIME NOT NULL, motivo VARCHAR(255) NOT NULL, entrada TINYINT(1) NOT NULL, INDEX IDX_BCCADB4CA9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asistencia ADD CONSTRAINT FK_D8264A8DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE novedad ADD CONSTRAINT FK_BCCADB4CA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE novedad DROP FOREIGN KEY FK_BCCADB4CA9276E6C');
        $this->addSql('DROP TABLE asistencia');
        $this->addSql('DROP TABLE novedad');
        $this->addSql('DROP TABLE tipo');
    }
}
