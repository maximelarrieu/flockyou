<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129103149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teams CHANGE league_id league_id INT DEFAULT NULL, CHANGE slug slug VARCHAR(6) DEFAULT NULL, CHANGE team_img team_img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE leagues CHANGE league_img league_img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE products CHANGE team_id team_id INT DEFAULT NULL, CHANGE state_id state_id INT DEFAULT NULL, CHANGE product_img product_img VARCHAR(255) DEFAULT NULL, CHANGE price price INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE leagues CHANGE league_img league_img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE products CHANGE team_id team_id INT DEFAULT NULL, CHANGE state_id state_id INT DEFAULT NULL, CHANGE product_img product_img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE price price INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teams CHANGE league_id league_id INT DEFAULT NULL, CHANGE slug slug VARCHAR(6) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE team_img team_img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
