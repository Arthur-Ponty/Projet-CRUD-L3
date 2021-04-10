<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325163446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, nom_auteur LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, note INT NOT NULL, txt_commentaire LONGTEXT NOT NULL, INDEX IDX_67F068BCFF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, appelation_officielle VARCHAR(255) NOT NULL, denomination VARCHAR(255) DEFAULT NULL, secteur enum(\'Public\',\'Privé\'), longitude INT DEFAULT NULL, latitude INT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, commune VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, academie VARCHAR(255) DEFAULT NULL, date_ouverture DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFF631228');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE etablissement');
    }
}
