<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807141153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, grade VARCHAR(50) NOT NULL, phone VARCHAR(10) NOT NULL, affiliation VARCHAR(50) NOT NULL, user_name VARCHAR(50) NOT NULL, services VARCHAR(50) NOT NULL, lieu VARCHAR(50) NOT NULL, vehicule VARCHAR(50) DEFAULT NULL, detail VARCHAR(255) DEFAULT NULL, is_service TINYINT(1) NOT NULL, start_at DATETIME DEFAULT NULL, tss INT DEFAULT NULL, last_tss INT DEFAULT NULL, total_tss INT DEFAULT NULL, faru VARCHAR(50) DEFAULT NULL, mtt VARCHAR(50) DEFAULT NULL, asg VARCHAR(50) DEFAULT NULL, pss TINYINT(1) NOT NULL, gos TINYINT(1) NOT NULL, gss TINYINT(1) NOT NULL, ams TINYINT(1) NOT NULL, vms TINYINT(1) NOT NULL, emt TINYINT(1) NOT NULL, ed VARCHAR(50) DEFAULT NULL, dsi TINYINT(1) NOT NULL, zd TINYINT(1) NOT NULL, amf TINYINT(1) NOT NULL, fpc TINYINT(1) NOT NULL, techasg TINYINT(1) NOT NULL, sf TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruitment_request (id INT AUTO_INCREMENT NOT NULL, hrp_first_name VARCHAR(50) NOT NULL, hrp_age INT NOT NULL, id_unique_game INT NOT NULL, pseudo_discord VARCHAR(100) NOT NULL, rp_first_name VARCHAR(50) NOT NULL, rp_last_name VARCHAR(50) NOT NULL, rp_sexe VARCHAR(255) NOT NULL, rp_birthday DATE NOT NULL, rp_phone VARCHAR(255) NOT NULL, motivation LONGTEXT NOT NULL, disponibility LONGTEXT NOT NULL, status_rec INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', voiture TINYINT(1) NOT NULL, moto TINYINT(1) NOT NULL, avion TINYINT(1) NOT NULL, helicoptere TINYINT(1) NOT NULL, camion TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE recruitment_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
