<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200711114752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE pax ADD chambre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pax ADD CONSTRAINT FK_898812AA9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_898812AA9B177F54 ON pax (chambre_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pax DROP FOREIGN KEY FK_898812AA9B177F54');
        $this->addSql('DROP INDEX UNIQ_898812AA9B177F54 ON pax');
        $this->addSql('ALTER TABLE pax DROP chambre_id');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
