<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919154558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve_services (eleve_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_67DF071DA6CC7B2 (eleve_id), INDEX IDX_67DF071DAEF5A6C1 (services_id), PRIMARY KEY(eleve_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve_services ADD CONSTRAINT FK_67DF071DA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_services ADD CONSTRAINT FK_67DF071DAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve_services DROP FOREIGN KEY FK_67DF071DA6CC7B2');
        $this->addSql('ALTER TABLE eleve_services DROP FOREIGN KEY FK_67DF071DAEF5A6C1');
        $this->addSql('DROP TABLE eleve_services');
    }
}
