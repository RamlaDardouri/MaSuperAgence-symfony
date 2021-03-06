<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004000326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proprety ADD surface INT NOT NULL, ADD rooms INT NOT NULL, ADD bedrooms INT NOT NULL, ADD floor INT NOT NULL, ADD price INT NOT NULL, ADD heat INT NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD sold TINYINT(1) DEFAULT \'0\' NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE titre title VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proprety ADD titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP title, DROP surface, DROP rooms, DROP bedrooms, DROP floor, DROP price, DROP heat, DROP city, DROP adress, DROP postal_code, DROP sold, DROP created_at');
    }
}
