<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223204758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calificaciones ADD asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE calificaciones ADD CONSTRAINT FK_41F72CC8C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignaturas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_41F72CC8C5C70C5B ON calificaciones (asignatura_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE calificaciones DROP CONSTRAINT FK_41F72CC8C5C70C5B');
        $this->addSql('DROP INDEX IDX_41F72CC8C5C70C5B');
        $this->addSql('ALTER TABLE calificaciones DROP asignatura_id');
    }
}
