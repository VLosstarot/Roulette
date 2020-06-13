<?php

declare(strict_types=1);

namespace App\Migrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200612091016 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql(
            '
            CREATE VIEW round_statistic AS
                SELECT t.round_id, count(distinct tu.user_id) as users_count
                    FROM turn t
                JOIN turn_user tu ON t.id = tu.turn_id
                GROUP BY t.round_id
            '
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP VIEW round_statistic');
    }
}
