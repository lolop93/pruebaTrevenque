<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223025334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumnos_asignaturas (alumnos_id INT NOT NULL, asignaturas_id INT NOT NULL, PRIMARY KEY(alumnos_id, asignaturas_id))');
        $this->addSql('CREATE INDEX IDX_D57EE88A03F5ABF ON alumnos_asignaturas (alumnos_id)');
        $this->addSql('CREATE INDEX IDX_D57EE881B0DF255 ON alumnos_asignaturas (asignaturas_id)');
        $this->addSql('ALTER TABLE alumnos_asignaturas ADD CONSTRAINT FK_D57EE88A03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE alumnos_asignaturas ADD CONSTRAINT FK_D57EE881B0DF255 FOREIGN KEY (asignaturas_id) REFERENCES asignaturas (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE alumnos_asignaturas');
    }
}
