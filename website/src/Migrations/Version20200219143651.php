<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219143651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livraison ADD user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE size_id size_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bank ADD user_id INT DEFAULT NULL, CHANGE cart_number cart_number VARCHAR(255) DEFAULT NULL, CHANGE expiration_date expiration_date DATE DEFAULT NULL, CHANGE cart_code cart_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bank ADD CONSTRAINT FK_D860BF7AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_D860BF7AA76ED395 ON bank (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bank DROP FOREIGN KEY FK_D860BF7AA76ED395');
        $this->addSql('DROP INDEX IDX_D860BF7AA76ED395 ON bank');
        $this->addSql('ALTER TABLE bank DROP user_id, CHANGE cart_number cart_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE expiration_date expiration_date DATE DEFAULT \'NULL\', CHANGE cart_code cart_code INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison CHANGE user_id user_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE city city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE size_id size_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
    }
}
