<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311135940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE abonne_id abonne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD continent_id INT NOT NULL, CHANGE ingredient_cle_id ingredient_cle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390921F4C77 ON recette (continent_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE abonne_id abonne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390921F4C77');
        $this->addSql('DROP INDEX IDX_49BB6390921F4C77 ON recette');
        $this->addSql('ALTER TABLE recette DROP continent_id, CHANGE ingredient_cle_id ingredient_cle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
