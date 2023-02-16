<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216103404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gerant_hotel ADD etablissement_hotel_id INT NOT NULL');
        $this->addSql('ALTER TABLE gerant_hotel ADD CONSTRAINT FK_5AD7EC87302A390D FOREIGN KEY (etablissement_hotel_id) REFERENCES etablissement_hotel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5AD7EC87302A390D ON gerant_hotel (etablissement_hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gerant_hotel DROP FOREIGN KEY FK_5AD7EC87302A390D');
        $this->addSql('DROP INDEX UNIQ_5AD7EC87302A390D ON gerant_hotel');
        $this->addSql('ALTER TABLE gerant_hotel DROP etablissement_hotel_id');
    }
}
