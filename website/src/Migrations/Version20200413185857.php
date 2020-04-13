<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413185857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP INDEX FK_1483A5E91AD5CDBF, ADD UNIQUE INDEX UNIQ_1483A5E91AD5CDBF (cart_id)');
        $this->addSql('ALTER TABLE users ADD birthday DATETIME DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE budget budget DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP INDEX UNIQ_1483A5E91AD5CDBF, ADD INDEX FK_1483A5E91AD5CDBF (cart_id)');
        $this->addSql('ALTER TABLE users DROP birthday, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE budget budget DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
