<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210926144829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reader ADD orderid_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reader ADD CONSTRAINT FK_CC3F893C6F90D45B FOREIGN KEY (orderid_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CC3F893C6F90D45B ON reader (orderid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reader DROP FOREIGN KEY FK_CC3F893C6F90D45B');
        $this->addSql('DROP INDEX UNIQ_CC3F893C6F90D45B ON reader');
        $this->addSql('ALTER TABLE reader DROP orderid_id');
    }
}
