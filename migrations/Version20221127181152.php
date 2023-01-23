<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127181152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson ADD school_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3C32A47EE ON lesson (school_id)');
        $this->addSql('ALTER TABLE school DROP FOREIGN KEY FK_F99EDABBCDF80196');
        $this->addSql('DROP INDEX IDX_F99EDABBCDF80196 ON school');
        $this->addSql('ALTER TABLE school DROP lesson_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3C32A47EE');
        $this->addSql('DROP INDEX IDX_F87474F3C32A47EE ON lesson');
        $this->addSql('ALTER TABLE lesson DROP school_id');
        $this->addSql('ALTER TABLE school ADD lesson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('CREATE INDEX IDX_F99EDABBCDF80196 ON school (lesson_id)');
    }
}
