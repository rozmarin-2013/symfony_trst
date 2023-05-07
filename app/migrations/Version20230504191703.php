<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504191703 extends AbstractMigration
{
    public const TABLE_NAME = 'currency_rates';
    public function getDescription(): string
    {
        return 'Create table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('currency_id', 'integer');
        $table->addColumn('amount', 'float');
        $table->setPrimaryKey(['id']);

        $table->addForeignKeyConstraint(Version20230504124930::TABLE_NAME, ['currency_id'], ['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
