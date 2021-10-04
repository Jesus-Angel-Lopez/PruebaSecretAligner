<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004180419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lista_todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, propietario_id INTEGER NOT NULL, nombre VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E0C8346553C8D32C ON lista_todo (propietario_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, nombre, realizada, fecha_creacion, fecha_tope FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lista_id INTEGER NOT NULL, nombre VARCHAR(255) NOT NULL COLLATE BINARY, realizada BOOLEAN NOT NULL, fecha_creacion DATETIME NOT NULL, fecha_tope DATETIME NOT NULL, CONSTRAINT FK_5A0EB6A06736D68F FOREIGN KEY (lista_id) REFERENCES lista_todo (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO todo (id, nombre, realizada, fecha_creacion, fecha_tope) SELECT id, nombre, realizada, fecha_creacion, fecha_tope FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
        $this->addSql('CREATE INDEX IDX_5A0EB6A06736D68F ON todo (lista_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lista_todo');
        $this->addSql('DROP INDEX IDX_5A0EB6A06736D68F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, nombre, fecha_creacion, fecha_tope, realizada FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_creacion DATETIME NOT NULL, fecha_tope DATETIME NOT NULL, realizada BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO todo (id, nombre, fecha_creacion, fecha_tope, realizada) SELECT id, nombre, fecha_creacion, fecha_tope, realizada FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
    }
}
