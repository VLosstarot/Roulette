<?php

declare(strict_types=1);

namespace App\Migrations;


use App\Helper\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200612090736 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $schemaManager = $this->connection->getSchemaManager();

        $this->addSql('CREATE TABLE IF NOT EXISTS turn (id SERIAL NOT NULL, round_id INT DEFAULT NULL, cell_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_20201547A6005CA0 ON turn (round_id)');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_20201547CB39D93A ON turn (cell_id)');
        if (!MigrationHelper::existForeignKey($schemaManager, 'turn', 'FK_20201547A6005CA0')) {
            $this->addSql('ALTER TABLE turn ADD CONSTRAINT FK_20201547A6005CA0 FOREIGN KEY (round_id) REFERENCES round (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        }
        if (!MigrationHelper::existForeignKey($schemaManager, 'turn', 'FK_20201547CB39D93A')) {
            $this->addSql('ALTER TABLE turn ADD CONSTRAINT FK_20201547CB39D93A FOREIGN KEY (cell_id) REFERENCES cell (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX IF EXISTS IDX_20201547A6005CA0');
        $this->addSql('DROP INDEX IF EXISTS IDX_20201547CB39D93A');
        $this->addSql('DROP TABLE IF EXISTS turn');
    }
}
