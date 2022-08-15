<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815154415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD contractual_company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEF0161C09 FOREIGN KEY (contractual_company_id) REFERENCES contractual_company (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEF0161C09 ON project (contractual_company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEF0161C09');
        $this->addSql('DROP INDEX IDX_2FB3D0EEF0161C09 ON project');
        $this->addSql('ALTER TABLE project DROP contractual_company_id');
    }
}
