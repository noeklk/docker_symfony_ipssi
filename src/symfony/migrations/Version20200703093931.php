<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703093931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flight ADD aircraft_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E846E2F5C FOREIGN KEY (aircraft_id) REFERENCES aircraft (id)');
        $this->addSql('CREATE INDEX IDX_C257E60E846E2F5C ON flight (aircraft_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E846E2F5C');
        $this->addSql('DROP INDEX IDX_C257E60E846E2F5C ON flight');
        $this->addSql('ALTER TABLE flight DROP aircraft_id');
    }
}
