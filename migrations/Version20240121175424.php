<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240121175424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE possede_billet ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE possede_billet MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON possede_billet');
        $this->addSql('ALTER TABLE possede_billet DROP id');
        $this->addSql('ALTER TABLE possede_billet ADD PRIMARY KEY (spectateur_id, billet_id)');
    }
}
