<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323190248 extends AbstractMigration
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
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCC325A696 FOREIGN KEY (abonne_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recette CHANGE ingredient_cle_id ingredient_cle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63901AE29D49 FOREIGN KEY (ingredient_cle_id) REFERENCES ingredient_cle (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC89312FE9');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCC325A696');
        $this->addSql('ALTER TABLE commentaire CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE abonne_id abonne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63901AE29D49');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390921F4C77');
        $this->addSql('ALTER TABLE recette CHANGE ingredient_cle_id ingredient_cle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
