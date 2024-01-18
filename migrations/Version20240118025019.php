<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118025019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP user_id');
        $this->addSql('ALTER TABLE user ADD spectateur_id INT DEFAULT NULL, ADD membre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AF471192 FOREIGN KEY (spectateur_id) REFERENCES spectateur (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AF471192 ON user (spectateur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6496A99F74A ON user (membre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AF471192');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496A99F74A');
        $this->addSql('DROP INDEX UNIQ_8D93D649AF471192 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D6496A99F74A ON user');
        $this->addSql('ALTER TABLE user DROP spectateur_id, DROP membre_id');
    }
}
