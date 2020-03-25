<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325144012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE size_id size_id INT DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE command_product ADD cart_products_id INT DEFAULT NULL, CHANGE command_id command_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574E3F5978E9 FOREIGN KEY (cart_products_id) REFERENCES cart_product (id)');
        $this->addSql('CREATE INDEX IDX_3C20574E3F5978E9 ON command_product (cart_products_id)');
        $this->addSql('ALTER TABLE users CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE budget budget DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE command CHANGE nb_command nb_command INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE size_id size_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bank CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) DEFAULT NULL, CHANGE expiration_date expiration_date DATE DEFAULT NULL, CHANGE cart_code cart_code INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bank CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE expiration_date expiration_date DATE DEFAULT \'NULL\', CHANGE cart_code cart_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_product CHANGE product_id product_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE size_id size_id INT DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command CHANGE nb_command nb_command INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574E3F5978E9');
        $this->addSql('DROP INDEX IDX_3C20574E3F5978E9 ON command_product');
        $this->addSql('ALTER TABLE command_product DROP cart_products_id, CHANGE command_id command_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE size_id size_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE budget budget DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
