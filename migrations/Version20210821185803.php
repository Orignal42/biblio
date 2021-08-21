<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210821185803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, comments VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_library (comment_id INT NOT NULL, library_id INT NOT NULL, INDEX IDX_52F3FAACF8697D13 (comment_id), INDEX IDX_52F3FAACFE2541D7 (library_id), PRIMARY KEY(comment_id, library_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_library ADD CONSTRAINT FK_52F3FAACF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_library ADD CONSTRAINT FK_52F3FAACFE2541D7 FOREIGN KEY (library_id) REFERENCES library (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment_library DROP FOREIGN KEY FK_52F3FAACF8697D13');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE comment_library');
    }
}
