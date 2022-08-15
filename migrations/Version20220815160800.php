<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815160800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coworker (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coworker_project (coworker_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_2063263AF74B0B0 (coworker_id), INDEX IDX_2063263A166D1F9C (project_id), PRIMARY KEY(coworker_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coworker_project ADD CONSTRAINT FK_2063263AF74B0B0 FOREIGN KEY (coworker_id) REFERENCES coworker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coworker_project ADD CONSTRAINT FK_2063263A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coworker_project DROP FOREIGN KEY FK_2063263AF74B0B0');
        $this->addSql('DROP TABLE coworker');
        $this->addSql('DROP TABLE coworker_project');
    }
}
