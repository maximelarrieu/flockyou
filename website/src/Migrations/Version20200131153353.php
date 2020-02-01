<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200131153353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles_users (roles_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_3D80FB2C38C751C4 (roles_id), INDEX IDX_3D80FB2C67B3B43D (users_id), PRIMARY KEY(roles_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE roles_users ADD CONSTRAINT FK_3D80FB2C38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles_users ADD CONSTRAINT FK_3D80FB2C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE leagues CHANGE league_img league_img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teams CHANGE league_id league_id INT DEFAULT NULL, CHANGE team_name team_name VARCHAR(255) NOT NULL, CHANGE slug slug VARCHAR(6) DEFAULT NULL, CHANGE team_img team_img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE products CHANGE team_id team_id INT DEFAULT NULL, CHANGE state_id state_id INT DEFAULT NULL, CHANGE stock_id stock_id INT DEFAULT NULL, CHANGE product_img product_img VARCHAR(255) DEFAULT NULL, CHANGE price price INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE roles_users DROP FOREIGN KEY FK_3D80FB2C38C751C4');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE roles_users');
        $this->addSql('ALTER TABLE leagues CHANGE league_img league_img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE products CHANGE team_id team_id INT DEFAULT NULL, CHANGE state_id state_id INT DEFAULT NULL, CHANGE stock_id stock_id INT DEFAULT NULL, CHANGE product_img product_img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE price price INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teams CHANGE league_id league_id INT DEFAULT NULL, CHANGE team_name team_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(6) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE team_img team_img VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
