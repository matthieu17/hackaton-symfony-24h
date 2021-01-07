<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609202359 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, id_createur_id INT NOT NULL, id_categorie_id INT DEFAULT NULL, id_departement_id INT UNSIGNED DEFAULT NULL, intitule VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL, date_creation DATETIME NOT NULL, nb_max_participants INT NOT NULL, INDEX IDX_F65593E56BB0CC12 (id_createur_id), INDEX IDX_F65593E59F34925F (id_categorie_id), INDEX IDX_F65593E5F19F5D18 (id_departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_utilisateur (annonce_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_69B3C5FC8805AB2F (annonce_id), INDEX IDX_69B3C5FCFB88E14F (utilisateur_id), PRIMARY KEY(annonce_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT UNSIGNED AUTO_INCREMENT NOT NULL, region_id INT UNSIGNED DEFAULT NULL, code VARCHAR(3) NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_C1765B6398260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT UNSIGNED AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX regions_code_unique (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, ville_id INT UNSIGNED DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, plain_password VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), INDEX IDX_1D1C63B3A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT UNSIGNED AUTO_INCREMENT NOT NULL, departement_id INT UNSIGNED DEFAULT NULL, insee_code VARCHAR(5) DEFAULT NULL, zip_code VARCHAR(5) DEFAULT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, gps_lat DOUBLE PRECISION NOT NULL, gps_lng DOUBLE PRECISION NOT NULL, INDEX IDX_43C3D9C3CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E56BB0CC12 FOREIGN KEY (id_createur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E59F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5F19F5D18 FOREIGN KEY (id_departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE annonce_utilisateur ADD CONSTRAINT FK_69B3C5FC8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_utilisateur ADD CONSTRAINT FK_69B3C5FCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B6398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonce_utilisateur DROP FOREIGN KEY FK_69B3C5FC8805AB2F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E59F34925F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5F19F5D18');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3CCF9E01E');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B6398260155');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E56BB0CC12');
        $this->addSql('ALTER TABLE annonce_utilisateur DROP FOREIGN KEY FK_69B3C5FCFB88E14F');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3A73F0036');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_utilisateur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE ville');
    }
}
