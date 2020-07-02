<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200702161108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE airport (id INT AUTO_INCREMENT NOT NULL, ident VARCHAR(10) DEFAULT NULL, type_a VARCHAR(20) DEFAULT NULL, name VARCHAR(130) DEFAULT NULL, latitude_deg NUMERIC(20, 17) DEFAULT NULL, longitude_deg NUMERIC(20, 17) DEFAULT NULL, elevation_ft INT DEFAULT NULL, iso_country VARCHAR(2) DEFAULT NULL, municipality VARCHAR(50) DEFAULT NULL, iata_code VARCHAR(3) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, departure_id INT DEFAULT NULL, arrival_id INT DEFAULT NULL, number VARCHAR(6) NOT NULL, price NUMERIC(7, 2) DEFAULT NULL, INDEX IDX_C257E60E7704ED06 (departure_id), INDEX IDX_C257E60E62789708 (arrival_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight_passenger (flight_id INT NOT NULL, passenger_id INT NOT NULL, INDEX IDX_25F7F56F91F478C5 (flight_id), INDEX IDX_25F7F56F4502E565 (passenger_id), PRIMARY KEY(flight_id, passenger_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, passport_number VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_3BEFE8DD4EF9AAC4 (passport_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E7704ED06 FOREIGN KEY (departure_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E62789708 FOREIGN KEY (arrival_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight_passenger ADD CONSTRAINT FK_25F7F56F91F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flight_passenger ADD CONSTRAINT FK_25F7F56F4502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E7704ED06');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60E62789708');
        $this->addSql('ALTER TABLE flight_passenger DROP FOREIGN KEY FK_25F7F56F91F478C5');
        $this->addSql('ALTER TABLE flight_passenger DROP FOREIGN KEY FK_25F7F56F4502E565');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE flight_passenger');
        $this->addSql('DROP TABLE passenger');
    }
}
