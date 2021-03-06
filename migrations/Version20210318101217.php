<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318101217 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, appelation_officielle VARCHAR(255) NOT NULL, denomination VARCHAR(255) DEFAULT NULL, secteur VARCHAR(255) DEFAULT NULL, longitude INT DEFAULT NULL, latitude INT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, academie VARCHAR(255) DEFAULT NULL, date_ouverture DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE etablissement');
    }
}
