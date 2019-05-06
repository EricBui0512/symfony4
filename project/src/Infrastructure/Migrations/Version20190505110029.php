<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190505110029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(191) DEFAULT NULL, username VARCHAR(191) NOT NULL, password_hash VARCHAR(191) NOT NULL, password_salt VARCHAR(191) NOT NULL, time_modified DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capabilities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL, description VARCHAR(191) DEFAULT NULL, UNIQUE INDEX UNIQ_1D3B2DFD5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE context (id INT AUTO_INCREMENT NOT NULL, context_level_id_id INT NOT NULL, intance INT NOT NULL, INDEX IDX_E25D857ED8C74602 (context_level_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE context_levels (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, database_table VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_28C62F4E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL, time_modified DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modifier_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_users (id INT AUTO_INCREMENT NOT NULL, group_id_id INT NOT NULL, user_id_id INT NOT NULL, time_start DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, time_end DATETIME DEFAULT NULL, modifier_id INT NOT NULL, INDEX IDX_44AF8E8E2F68B530 (group_id_id), INDEX IDX_44AF8E8E9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL, short_name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_57698A6A5E237E06 (name), UNIQUE INDEX UNIQ_57698A6A3EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_assignment (id INT AUTO_INCREMENT NOT NULL, role_id_id INT NOT NULL, context_id_id INT NOT NULL, user_id_id INT NOT NULL, time_start DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, time_end DATETIME DEFAULT NULL, time_modified DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modifier_id INT NOT NULL, INDEX IDX_BFF12E9688987678 (role_id_id), INDEX IDX_BFF12E962E53F229 (context_id_id), INDEX IDX_BFF12E969D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_capabilities (id INT AUTO_INCREMENT NOT NULL, context_level_id_id INT NOT NULL, role_id_id INT NOT NULL, capability_id_id INT NOT NULL, time_modified DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modifier_id INT NOT NULL, INDEX IDX_896D4121D8C74602 (context_level_id_id), INDEX IDX_896D412188987678 (role_id_id), INDEX IDX_896D4121FF420C64 (capability_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE context ADD CONSTRAINT FK_E25D857ED8C74602 FOREIGN KEY (context_level_id_id) REFERENCES context_levels (id)');
        $this->addSql('ALTER TABLE group_users ADD CONSTRAINT FK_44AF8E8E2F68B530 FOREIGN KEY (group_id_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE group_users ADD CONSTRAINT FK_44AF8E8E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE role_assignment ADD CONSTRAINT FK_BFF12E9688987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE role_assignment ADD CONSTRAINT FK_BFF12E962E53F229 FOREIGN KEY (context_id_id) REFERENCES context (id)');
        $this->addSql('ALTER TABLE role_assignment ADD CONSTRAINT FK_BFF12E969D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE role_capabilities ADD CONSTRAINT FK_896D4121D8C74602 FOREIGN KEY (context_level_id_id) REFERENCES context_levels (id)');
        $this->addSql('ALTER TABLE role_capabilities ADD CONSTRAINT FK_896D412188987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE role_capabilities ADD CONSTRAINT FK_896D4121FF420C64 FOREIGN KEY (capability_id_id) REFERENCES capabilities (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_users DROP FOREIGN KEY FK_44AF8E8E9D86650F');
        $this->addSql('ALTER TABLE role_assignment DROP FOREIGN KEY FK_BFF12E969D86650F');
        $this->addSql('ALTER TABLE role_capabilities DROP FOREIGN KEY FK_896D4121FF420C64');
        $this->addSql('ALTER TABLE role_assignment DROP FOREIGN KEY FK_BFF12E962E53F229');
        $this->addSql('ALTER TABLE context DROP FOREIGN KEY FK_E25D857ED8C74602');
        $this->addSql('ALTER TABLE role_capabilities DROP FOREIGN KEY FK_896D4121D8C74602');
        $this->addSql('ALTER TABLE group_users DROP FOREIGN KEY FK_44AF8E8E2F68B530');
        $this->addSql('ALTER TABLE role_assignment DROP FOREIGN KEY FK_BFF12E9688987678');
        $this->addSql('ALTER TABLE role_capabilities DROP FOREIGN KEY FK_896D412188987678');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE capabilities');
        $this->addSql('DROP TABLE context');
        $this->addSql('DROP TABLE context_levels');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE group_users');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_assignment');
        $this->addSql('DROP TABLE role_capabilities');
    }
}
