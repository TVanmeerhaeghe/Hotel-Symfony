<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126134716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suite_hotel ADD etablissement_hotel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suite_hotel ADD CONSTRAINT FK_25DA13F3302A390D FOREIGN KEY (etablissement_hotel_id) REFERENCES etablissement_hotel (id)');
        $this->addSql('CREATE INDEX IDX_25DA13F3302A390D ON suite_hotel (etablissement_hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suite_hotel DROP FOREIGN KEY FK_25DA13F3302A390D');
        $this->addSql('DROP INDEX IDX_25DA13F3302A390D ON suite_hotel');
        $this->addSql('ALTER TABLE suite_hotel DROP etablissement_hotel_id');
    }
}
