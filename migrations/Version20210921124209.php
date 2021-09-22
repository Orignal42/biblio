<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921124209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reader ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reader ADD CONSTRAINT FK_CC3F893CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CC3F893CA76ED395 ON reader (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reader DROP FOREIGN KEY FK_CC3F893CA76ED395');
        $this->addSql('DROP INDEX UNIQ_CC3F893CA76ED395 ON reader');
        $this->addSql('ALTER TABLE reader DROP user_id');
    }
}
