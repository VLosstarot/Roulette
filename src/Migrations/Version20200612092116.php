<?php

declare(strict_types=1);

namespace App\Migrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200612092116 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql(
            '
            CREATE VIEW user_statistic AS
            SELECT q.user_id, count(distinct q.round_id) AS rounds_count, avg(q.count) AS avg_turn_count
                FROM (
                    SELECT count(t.id), tu.user_id, t.round_id
                        FROM turn t
                    JOIN turn_user tu ON t.id = tu.turn_id
                    GROUP BY tu.user_id, t.round_id) q
            GROUP BY q.user_id
            '
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP VIEW user_statistic');
    }
}
