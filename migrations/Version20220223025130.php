<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223025130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alumnos_asignaturas');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE alumnos_asignaturas (alumnos_id INT NOT NULL, asignaturas_id INT NOT NULL, PRIMARY KEY(alumnos_id, asignaturas_id))');
        $this->addSql('CREATE INDEX idx_d57ee88a03f5abf ON alumnos_asignaturas (alumnos_id)');
        $this->addSql('CREATE INDEX idx_d57ee881b0df255 ON alumnos_asignaturas (asignaturas_id)');
        $this->addSql('ALTER TABLE alumnos_asignaturas ADD CONSTRAINT fk_d57ee88a03f5abf FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE alumnos_asignaturas ADD CONSTRAINT fk_d57ee881b0df255 FOREIGN KEY (asignaturas_id) REFERENCES asignaturas (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
