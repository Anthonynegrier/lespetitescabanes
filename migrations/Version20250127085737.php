<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127085737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creche DROP FOREIGN KEY FK_6A2569C81C109075');
        $this->addSql('DROP INDEX IDX_6A2569C81C109075 ON creche');
        $this->addSql('ALTER TABLE creche DROP personnel_id');
        $this->addSql('ALTER TABLE personnel ADD creche_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE6C6060B FOREIGN KEY (creche_id) REFERENCES creche (id)');
        $this->addSql('CREATE INDEX IDX_A6BCF3DE6C6060B ON personnel (creche_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creche ADD personnel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE creche ADD CONSTRAINT FK_6A2569C81C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_6A2569C81C109075 ON creche (personnel_id)');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE6C6060B');
        $this->addSql('DROP INDEX IDX_A6BCF3DE6C6060B ON personnel');
        $this->addSql('ALTER TABLE personnel DROP creche_id');
    }
}
