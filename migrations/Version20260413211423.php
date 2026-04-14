<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260413211423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conseiller (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, age INT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, cours VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, filiere_id INT NOT NULL, etablissement_id INT NOT NULL, conseiller_id INT NOT NULL, INDEX IDX_717E22E3180AA129 (filiere_id), INDEX IDX_717E22E3FF631228 (etablissement_id), INDEX IDX_717E22E31AC39A0D (conseiller_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etudiant_enseignant (etudiant_id INT NOT NULL, enseignant_id INT NOT NULL, INDEX IDX_4F0840DBDDEAB1A3 (etudiant_id), INDEX IDX_4F0840DBE455FCC0 (enseignant_id), PRIMARY KEY (etudiant_id, enseignant_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(50) NOT NULL, credit INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, resultat_id INT NOT NULL, UNIQUE INDEX UNIQ_A412FA92D233E95C (resultat_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE resultat (id INT AUTO_INCREMENT NOT NULL, score DOUBLE PRECISION NOT NULL, mention VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E31AC39A0D FOREIGN KEY (conseiller_id) REFERENCES conseiller (id)');
        $this->addSql('ALTER TABLE etudiant_enseignant ADD CONSTRAINT FK_4F0840DBDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_enseignant ADD CONSTRAINT FK_4F0840DBE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92D233E95C FOREIGN KEY (resultat_id) REFERENCES resultat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3180AA129');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3FF631228');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E31AC39A0D');
        $this->addSql('ALTER TABLE etudiant_enseignant DROP FOREIGN KEY FK_4F0840DBDDEAB1A3');
        $this->addSql('ALTER TABLE etudiant_enseignant DROP FOREIGN KEY FK_4F0840DBE455FCC0');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92D233E95C');
        $this->addSql('DROP TABLE conseiller');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE etudiant_enseignant');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE resultat');
    }
}
