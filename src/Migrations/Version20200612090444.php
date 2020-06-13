<?php

declare(strict_types=1);

namespace App\Migrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200612090444 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS round (id SERIAL NOT NULL, is_finished BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE IF NOT EXISTS cell (id SERIAL NOT NULL, weight INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE IF NOT EXISTS "user" (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE IF EXISTS round');
        $this->addSql('DROP TABLE IF EXISTS cell');
        $this->addSql('DROP TABLE IF EXISTS "user"');
    }
}
