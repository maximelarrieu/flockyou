<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324091725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id), users_id INT DEFAULT NULL) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_product ADD cart_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE size_id size_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_2890CCAA1AD5CDBF ON cart_product (cart_id)');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE budget budget DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE size_id size_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bank CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) DEFAULT NULL, CHANGE expiration_date expiration_date DATE DEFAULT NULL, CHANGE cart_code cart_code INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA1AD5CDBF');
        $this->addSql('DROP TABLE cart');
        $this->addSql('ALTER TABLE bank CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE expiration_date expiration_date DATE DEFAULT \'NULL\', CHANGE cart_code cart_code INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_2890CCAA1AD5CDBF ON cart_product');
        $this->addSql('ALTER TABLE cart_product DROP cart_id, CHANGE product_id product_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE size_id size_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE size_id size_id INT DEFAULT NULL, CHANGE flocage_id flocage_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE budget budget DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
