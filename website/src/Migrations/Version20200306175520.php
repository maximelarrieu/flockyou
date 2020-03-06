<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306175520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
//        $this->addSql('ALTER TABLE cart CHANGE user_id user_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE cart_product MODIFY id INT NOT NULL');
//        $this->addSql('ALTER TABLE cart_product DROP PRIMARY KEY');
//        $this->addSql('ALTER TABLE cart_product DROP id, CHANGE cart_id cart_id INT NOT NULL, CHANGE product_id product_id INT NOT NULL');
//        $this->addSql('ALTER TABLE cart_product ADD PRIMARY KEY (cart_id, product_id)');
//        $this->addSql('ALTER TABLE cart_product RENAME INDEX fk_2890ccaa1ad5cdbf TO IDX_2890CCAA1AD5CDBF');
//        $this->addSql('ALTER TABLE cart_product RENAME INDEX fk_2890ccaa4584665a TO IDX_2890CCAA4584665A');
        $this->addSql('ALTER TABLE product ADD flocage_id INT DEFAULT NULL, CHANGE size_id size_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4BF3E62F FOREIGN KEY (flocage_id) REFERENCES flocage (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD4BF3E62F ON product (flocage_id)');
//        $this->addSql('ALTER TABLE bank CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) DEFAULT NULL, CHANGE expiration_date expiration_date DATE DEFAULT NULL, CHANGE cart_code cart_code INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('ALTER TABLE bank CHANGE user_id user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE expiration_date expiration_date DATE DEFAULT \'NULL\', CHANGE cart_code cart_code INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE cart CHANGE user_id user_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE cart_product ADD id INT AUTO_INCREMENT NOT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE product_id product_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
//        $this->addSql('ALTER TABLE cart_product RENAME INDEX idx_2890ccaa1ad5cdbf TO FK_2890CCAA1AD5CDBF');
//        $this->addSql('ALTER TABLE cart_product RENAME INDEX idx_2890ccaa4584665a TO FK_2890CCAA4584665A');
//        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4BF3E62F');
        $this->addSql('DROP INDEX IDX_D34A04AD4BF3E62F ON product');
        $this->addSql('ALTER TABLE product DROP flocage_id, CHANGE size_id size_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
    }
}
