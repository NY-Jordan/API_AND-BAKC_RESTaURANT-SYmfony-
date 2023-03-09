<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307161726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8ECAEAD4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_menu (command_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_DCAF941E33E1689A (command_id), INDEX IDX_DCAF941ECCD7E912 (menu_id), PRIMARY KEY(command_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_dishes (command_id INT NOT NULL, dishes_id INT NOT NULL, INDEX IDX_E70E1A1E33E1689A (command_id), INDEX IDX_E70E1A1EA05DD37A (dishes_id), PRIMARY KEY(command_id, dishes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_menu ADD CONSTRAINT FK_DCAF941E33E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_menu ADD CONSTRAINT FK_DCAF941ECCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_dishes ADD CONSTRAINT FK_E70E1A1E33E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_dishes ADD CONSTRAINT FK_E70E1A1EA05DD37A FOREIGN KEY (dishes_id) REFERENCES dishes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A76ED395');
        $this->addSql('ALTER TABLE command_menu DROP FOREIGN KEY FK_DCAF941E33E1689A');
        $this->addSql('ALTER TABLE command_menu DROP FOREIGN KEY FK_DCAF941ECCD7E912');
        $this->addSql('ALTER TABLE command_dishes DROP FOREIGN KEY FK_E70E1A1E33E1689A');
        $this->addSql('ALTER TABLE command_dishes DROP FOREIGN KEY FK_E70E1A1EA05DD37A');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_menu');
        $this->addSql('DROP TABLE command_dishes');
    }
}
