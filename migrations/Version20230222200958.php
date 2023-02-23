<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222200958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personne_hobbie (personne_id INT NOT NULL, hobbie_id INT NOT NULL, INDEX IDX_29E6911AA21BD112 (personne_id), INDEX IDX_29E6911A50B678B7 (hobbie_id), PRIMARY KEY(personne_id, hobbie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne_hobbie ADD CONSTRAINT FK_29E6911AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_hobbie ADD CONSTRAINT FK_29E6911A50B678B7 FOREIGN KEY (hobbie_id) REFERENCES hobbie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne_hobbie DROP FOREIGN KEY FK_29E6911AA21BD112');
        $this->addSql('ALTER TABLE personne_hobbie DROP FOREIGN KEY FK_29E6911A50B678B7');
        $this->addSql('DROP TABLE personne_hobbie');
    }
}
