<?php

declare(strict_types=1);

namespace App\Migrations;


use App\Helper\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200612090816 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $schemaManager = $this->connection->getSchemaManager();

        $this->addSql('CREATE TABLE IF NOT EXISTS turn_user (turn_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(turn_id, user_id))');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_F06BE7E41F4F9889 ON turn_user (turn_id)');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_F06BE7E4A76ED395 ON turn_user (user_id)');
        if (!MigrationHelper::existForeignKey($schemaManager, 'turn', 'FK_F06BE7E41F4F9889')) {
            $this->addSql('ALTER TABLE turn_user ADD CONSTRAINT FK_F06BE7E41F4F9889 FOREIGN KEY (turn_id) REFERENCES turn (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        }
        if (!MigrationHelper::existForeignKey($schemaManager, 'turn', 'FK_F06BE7E4A76ED395')) {
            $this->addSql('ALTER TABLE turn_user ADD CONSTRAINT FK_F06BE7E4A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX IF EXISTS IDX_F06BE7E41F4F9889');
        $this->addSql('DROP INDEX IF EXISTS IDX_F06BE7E4A76ED395');
        $this->addSql('DROP TABLE IF EXISTS turn_user');
    }
}
