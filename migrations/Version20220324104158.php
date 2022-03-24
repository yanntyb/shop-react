<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324104158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_cart (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA1AD5CDBF');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA4584665A');
        $this->addSql('ALTER TABLE cart_product ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product DROP cart');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_cart');
        $this->addSql('ALTER TABLE cart_product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA4584665A');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA1AD5CDBF');
        $this->addSql('ALTER TABLE cart_product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE cart_product DROP id');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product ADD PRIMARY KEY (cart_id, product_id)');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE product ADD cart INT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image image LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
