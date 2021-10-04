<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004111903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, nombre, fecha_creacion, fecha_tope, realizada FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL COLLATE BINARY, realizada BOOLEAN NOT NULL, fecha_creacion DATE NOT NULL, fecha_tope DATE NOT NULL)');
        $this->addSql('INSERT INTO todo (id, nombre, fecha_creacion, fecha_tope, realizada) SELECT id, nombre, fecha_creacion, fecha_tope, realizada FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, nombre, fecha_creacion, fecha_tope, realizada FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, realizada BOOLEAN NOT NULL, fecha_creacion DATETIME NOT NULL, fecha_tope DATETIME NOT NULL)');
        $this->addSql('INSERT INTO todo (id, nombre, fecha_creacion, fecha_tope, realizada) SELECT id, nombre, fecha_creacion, fecha_tope, realizada FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
    }
}
