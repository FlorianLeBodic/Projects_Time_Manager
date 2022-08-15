<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815163543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coworker ADD contractual_company_id INT NOT NULL');
        $this->addSql('ALTER TABLE coworker ADD CONSTRAINT FK_68C85AFCF0161C09 FOREIGN KEY (contractual_company_id) REFERENCES contractual_company (id)');
        $this->addSql('CREATE INDEX IDX_68C85AFCF0161C09 ON coworker (contractual_company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coworker DROP FOREIGN KEY FK_68C85AFCF0161C09');
        $this->addSql('DROP INDEX IDX_68C85AFCF0161C09 ON coworker');
        $this->addSql('ALTER TABLE coworker DROP contractual_company_id');
    }
}
