<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304092301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE analyse (id INT AUTO_INCREMENT NOT NULL, analyse_type VARCHAR(255) NOT NULL, result LONGBLOB DEFAULT NULL, appointment_id INT NOT NULL, INDEX IDX_351B0C7EE5B533F9 (appointment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, patient_status TINYINT(1) DEFAULT NULL, progress VARCHAR(255) NOT NULL, patient_id INT NOT NULL, doctor_id INT NOT NULL, hour_id INT DEFAULT NULL, INDEX IDX_FE38F8446B899279 (patient_id), UNIQUE INDEX UNIQ_FE38F84487F4FB17 (doctor_id), INDEX IDX_FE38F844B5937BF9 (hour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE avilibility (id INT AUTO_INCREMENT NOT NULL, duration INT DEFAULT NULL, doctor_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_ED42F0E587F4FB17 (doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE avilibility_day (avilibility_id INT NOT NULL, day_id INT NOT NULL, INDEX IDX_E05A41F245061697 (avilibility_id), INDEX IDX_E05A41F29C24126 (day_id), PRIMARY KEY(avilibility_id, day_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, details VARCHAR(255) DEFAULT NULL, creation_date INT NOT NULL, doctor_id INT NOT NULL, INDEX IDX_C015514387F4FB17 (doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, day INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `day_hour` (day_id INT NOT NULL, hour_id INT NOT NULL, INDEX IDX_DB76FC389C24126 (day_id), INDEX IDX_DB76FC38B5937BF9 (hour_id), PRIMARY KEY(day_id, hour_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, specialty VARCHAR(255) NOT NULL, office_region VARCHAR(255) NOT NULL, office_address VARCHAR(255) NOT NULL, office_phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE doctor_secretary (doctor_id INT NOT NULL, secretary_id INT NOT NULL, INDEX IDX_4CC0623587F4FB17 (doctor_id), INDEX IDX_4CC06235A2A63DB2 (secretary_id), PRIMARY KEY(doctor_id, secretary_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE hour (id INT AUTO_INCREMENT NOT NULL, start_time VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, medicines VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, appointment_id INT DEFAULT NULL, INDEX IDX_1FBFB8D9E5B533F9 (appointment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE secretary (id INT AUTO_INCREMENT NOT NULL, year_exp INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, gender TINYINT(1) NOT NULL, birthdate VARCHAR(255) NOT NULL, creation_date INT NOT NULL, patient_id INT DEFAULT NULL, secretary_id INT DEFAULT NULL, doctor_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6496B899279 (patient_id), UNIQUE INDEX UNIQ_8D93D649A2A63DB2 (secretary_id), UNIQUE INDEX UNIQ_8D93D64987F4FB17 (doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE analyse ADD CONSTRAINT FK_351B0C7EE5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8446B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84487F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844B5937BF9 FOREIGN KEY (hour_id) REFERENCES hour (id)');
        $this->addSql('ALTER TABLE avilibility ADD CONSTRAINT FK_ED42F0E587F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE avilibility_day ADD CONSTRAINT FK_E05A41F245061697 FOREIGN KEY (avilibility_id) REFERENCES avilibility (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avilibility_day ADD CONSTRAINT FK_E05A41F29C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C015514387F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE `day_hour` ADD CONSTRAINT FK_DB76FC389C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `day_hour` ADD CONSTRAINT FK_DB76FC38B5937BF9 FOREIGN KEY (hour_id) REFERENCES hour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_secretary ADD CONSTRAINT FK_4CC0623587F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_secretary ADD CONSTRAINT FK_4CC06235A2A63DB2 FOREIGN KEY (secretary_id) REFERENCES secretary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A2A63DB2 FOREIGN KEY (secretary_id) REFERENCES secretary (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64987F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE analyse DROP FOREIGN KEY FK_351B0C7EE5B533F9');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8446B899279');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84487F4FB17');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844B5937BF9');
        $this->addSql('ALTER TABLE avilibility DROP FOREIGN KEY FK_ED42F0E587F4FB17');
        $this->addSql('ALTER TABLE avilibility_day DROP FOREIGN KEY FK_E05A41F245061697');
        $this->addSql('ALTER TABLE avilibility_day DROP FOREIGN KEY FK_E05A41F29C24126');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C015514387F4FB17');
        $this->addSql('ALTER TABLE `day_hour` DROP FOREIGN KEY FK_DB76FC389C24126');
        $this->addSql('ALTER TABLE `day_hour` DROP FOREIGN KEY FK_DB76FC38B5937BF9');
        $this->addSql('ALTER TABLE doctor_secretary DROP FOREIGN KEY FK_4CC0623587F4FB17');
        $this->addSql('ALTER TABLE doctor_secretary DROP FOREIGN KEY FK_4CC06235A2A63DB2');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D9E5B533F9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496B899279');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A2A63DB2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64987F4FB17');
        $this->addSql('DROP TABLE analyse');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE avilibility');
        $this->addSql('DROP TABLE avilibility_day');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE `day_hour`');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE doctor_secretary');
        $this->addSql('DROP TABLE hour');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE secretary');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
