<?php

declare(strict_types=1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190506023924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_users DROP FOREIGN KEY FK_44AF8E8E2F68B530');
        $this->addSql('CREATE TABLE chat_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL, time_modified DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modifier_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_group (id INT AUTO_INCREMENT NOT NULL, group_id_id INT NOT NULL, user_id_id INT NOT NULL, time_start DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, time_end DATETIME DEFAULT NULL, modifier_id INT NOT NULL, INDEX IDX_8AB7E08C2F68B530 (group_id_id), INDEX IDX_8AB7E08C9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_group ADD CONSTRAINT FK_8AB7E08C2F68B530 FOREIGN KEY (group_id_id) REFERENCES chat_group (id)');
        $this->addSql('ALTER TABLE users_group ADD CONSTRAINT FK_8AB7E08C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE group_users');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_group DROP FOREIGN KEY FK_8AB7E08C2F68B530');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, time_modified DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modifier_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE group_users (id INT AUTO_INCREMENT NOT NULL, group_id_id INT NOT NULL, user_id_id INT NOT NULL, time_start DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, time_end DATETIME DEFAULT NULL, modifier_id INT NOT NULL, INDEX IDX_44AF8E8E2F68B530 (group_id_id), INDEX IDX_44AF8E8E9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE group_users ADD CONSTRAINT FK_44AF8E8E2F68B530 FOREIGN KEY (group_id_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE group_users ADD CONSTRAINT FK_44AF8E8E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE chat_group');
        $this->addSql('DROP TABLE users_group');
    }
}
