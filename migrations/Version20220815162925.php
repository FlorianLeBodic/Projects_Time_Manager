<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815162925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hours_on_the_road (id INT AUTO_INCREMENT NOT NULL, coworker_id INT NOT NULL, project_id INT NOT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, INDEX IDX_FBEE5D44F74B0B0 (coworker_id), INDEX IDX_FBEE5D44166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours_to_customer_company (id INT AUTO_INCREMENT NOT NULL, coworker_id INT DEFAULT NULL, project_id INT DEFAULT NULL, started_at DATETIME NOT NULL, ended_at DATETIME DEFAULT NULL, INDEX IDX_E4F0C75DF74B0B0 (coworker_id), INDEX IDX_E4F0C75D166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hours_on_the_road ADD CONSTRAINT FK_FBEE5D44F74B0B0 FOREIGN KEY (coworker_id) REFERENCES coworker (id)');
        $this->addSql('ALTER TABLE hours_on_the_road ADD CONSTRAINT FK_FBEE5D44166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE hours_to_customer_company ADD CONSTRAINT FK_E4F0C75DF74B0B0 FOREIGN KEY (coworker_id) REFERENCES coworker (id)');
        $this->addSql('ALTER TABLE hours_to_customer_company ADD CONSTRAINT FK_E4F0C75D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hours_on_the_road');
        $this->addSql('DROP TABLE hours_to_customer_company');
    }
}
