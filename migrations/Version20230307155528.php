<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307155528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D82EA2E54');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9382EA2E54');
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DCCD7E912');
        $this->addSql('DROP INDEX IDX_584DD35DCCD7E912 ON dishes');
        $this->addSql('DROP INDEX IDX_584DD35D82EA2E54 ON dishes');
        $this->addSql('ALTER TABLE dishes DROP menu_id, DROP commande_id');
        $this->addSql('DROP INDEX IDX_7D053A9382EA2E54 ON menu');
        $this->addSql('ALTER TABLE menu DROP commande_id, DROP price, DROP created_at, DROP updated_at, DROP satus');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dishes ADD menu_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_584DD35DCCD7E912 ON dishes (menu_id)');
        $this->addSql('CREATE INDEX IDX_584DD35D82EA2E54 ON dishes (commande_id)');
        $this->addSql('ALTER TABLE menu ADD commande_id INT DEFAULT NULL, ADD price INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD satus TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_7D053A9382EA2E54 ON menu (commande_id)');
    }
}
