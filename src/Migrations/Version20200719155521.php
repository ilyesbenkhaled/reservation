<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200719155521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pax ADD father_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pax ADD CONSTRAINT FK_898812AA327CF5D0 FOREIGN KEY (father_name_id) REFERENCES child (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_898812AA327CF5D0 ON pax (father_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pax DROP FOREIGN KEY FK_898812AA327CF5D0');
        $this->addSql('DROP INDEX UNIQ_898812AA327CF5D0 ON pax');
        $this->addSql('ALTER TABLE pax DROP father_name_id');
    }
}
