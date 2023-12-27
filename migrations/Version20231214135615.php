<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214135615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE classe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE date_reponse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE matiere_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE niveau_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE professeur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE classe (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE date_reponse (id INT NOT NULL, question_id INT NOT NULL, date DATE NOT NULL, est_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6651D93A1E27F6BF ON date_reponse (question_id)');
        $this->addSql('CREATE TABLE matiere (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE matiere_classe (matiere_id INT NOT NULL, classe_id INT NOT NULL, PRIMARY KEY(matiere_id, classe_id))');
        $this->addSql('CREATE INDEX IDX_AF649A8BF46CD258 ON matiere_classe (matiere_id)');
        $this->addSql('CREATE INDEX IDX_AF649A8B8F5EA509 ON matiere_classe (classe_id)');
        $this->addSql('CREATE TABLE niveau (id INT NOT NULL, nom VARCHAR(255) NOT NULL, position INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE professeur (id INT NOT NULL, matiere_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17A55299F46CD258 ON professeur (matiere_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, classe_id INT NOT NULL, professeur_id INT DEFAULT NULL, supprimer_par_id INT DEFAULT NULL, date_validite DATE DEFAULT NULL, signalement BOOLEAN NOT NULL, question TEXT NOT NULL, reponse TEXT NOT NULL, visible BOOLEAN NOT NULL, creer_le DATE NOT NULL, modifie_le DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E8F5EA509 ON question (classe_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EBAB22EE9 ON question (professeur_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E62FE331F ON question (supprimer_par_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, admin BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE date_reponse ADD CONSTRAINT FK_6651D93A1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matiere_classe ADD CONSTRAINT FK_AF649A8BF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matiere_classe ADD CONSTRAINT FK_AF649A8B8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E62FE331F FOREIGN KEY (supprimer_par_id) REFERENCES professeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE classe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE date_reponse_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE matiere_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE niveau_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE professeur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE date_reponse DROP CONSTRAINT FK_6651D93A1E27F6BF');
        $this->addSql('ALTER TABLE matiere_classe DROP CONSTRAINT FK_AF649A8BF46CD258');
        $this->addSql('ALTER TABLE matiere_classe DROP CONSTRAINT FK_AF649A8B8F5EA509');
        $this->addSql('ALTER TABLE professeur DROP CONSTRAINT FK_17A55299F46CD258');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E8F5EA509');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EBAB22EE9');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E62FE331F');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE date_reponse');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_classe');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE "user"');
    }
}
