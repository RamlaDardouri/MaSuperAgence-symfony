<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211008165512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE proprety_option (proprety_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_664E2415E838838F (proprety_id), INDEX IDX_664E2415A7C41D6F (option_id), PRIMARY KEY(proprety_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proprety_option ADD CONSTRAINT FK_664E2415E838838F FOREIGN KEY (proprety_id) REFERENCES proprety (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proprety_option ADD CONSTRAINT FK_664E2415A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE proprety_option');
    }
}
