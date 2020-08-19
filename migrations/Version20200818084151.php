<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818084151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tags ADD CONSTRAINT FK_6FBC9426A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_6FBC9426A76ED395 ON tags (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags DROP FOREIGN KEY FK_6FBC9426A76ED395');
        $this->addSql('DROP INDEX IDX_6FBC9426A76ED395 ON tags');
        $this->addSql('ALTER TABLE tags DROP user_id');
    }
}
