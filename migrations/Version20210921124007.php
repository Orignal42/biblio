<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921124007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491717D737');
        $this->addSql('DROP INDEX UNIQ_8D93D6491717D737 ON user');
        $this->addSql('ALTER TABLE user DROP reader_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD reader_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491717D737 FOREIGN KEY (reader_id) REFERENCES reader (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491717D737 ON user (reader_id)');
    }
}
