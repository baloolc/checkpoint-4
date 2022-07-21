<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721101755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card CHANGE api_id api_id INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE power power INT DEFAULT NULL, CHANGE toughness toughness INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card CHANGE api_id api_id INT NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE power power INT NOT NULL, CHANGE toughness toughness INT NOT NULL');
    }
}
