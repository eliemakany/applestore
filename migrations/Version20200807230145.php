<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200807230145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add relation between users and apples';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apples ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE apples ADD CONSTRAINT FK_70CCB02FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_70CCB02FA76ED395 ON apples (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apples DROP FOREIGN KEY FK_70CCB02FA76ED395');
        $this->addSql('DROP INDEX IDX_70CCB02FA76ED395 ON apples');
        $this->addSql('ALTER TABLE apples DROP user_id');
    }
}
