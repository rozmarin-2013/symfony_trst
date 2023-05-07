<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505075413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert currencies USD, EUR, GBR';
    }

    public function up(Schema $schema): void
    {
        $this->addSQL(
            'INSERT INTO ' . Version20230504124930::TABLE_NAME . '(code) VALUES ("USD"), ("EUR"), ("GBR")'
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSQL(
            'DELETE FROM ' . Version20230504124930::TABLE_NAME
        );
    }
}
