<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200815094332 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apple_tag (apple_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_AC6B868B571323F9 (apple_id), INDEX IDX_AC6B868BBAD26311 (tag_id), PRIMARY KEY(apple_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apple_tag ADD CONSTRAINT FK_AC6B868B571323F9 FOREIGN KEY (apple_id) REFERENCES apples (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apple_tag ADD CONSTRAINT FK_AC6B868BBAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apple_tag DROP FOREIGN KEY FK_AC6B868BBAD26311');
        $this->addSql('DROP TABLE apple_tag');
        $this->addSql('DROP TABLE tags');
    }
}
