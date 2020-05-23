<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200523105516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parents DROP created_at');
        $this->addSql('ALTER TABLE user ADD pays_naissance VARCHAR(255) DEFAULT NULL, ADD date_deces DATE DEFAULT NULL, ADD ville_deces VARCHAR(255) DEFAULT NULL, ADD pays_deces VARCHAR(255) DEFAULT NULL, CHANGE date date_naissance DATE DEFAULT NULL, CHANGE lieu ville_naissance VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parents ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD date DATE DEFAULT NULL, ADD lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP date_naissance, DROP ville_naissance, DROP pays_naissance, DROP date_deces, DROP ville_deces, DROP pays_deces');
    }
}
