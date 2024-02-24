<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Secretary;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Instanciate Faker
        $faker = Factory::create('fr_FR');

        // Create Users and associate with entities
        for ($i = 0; $i < 1000; $i++) {
            // Create User
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword('password'); // Set a default password, you might want to use a better approach for passwords
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setPhone($faker->phoneNumber);
            $user->setGender($faker->boolean);
            $user->setBirthdate($faker->dateTimeThisCentury->getTimestamp());
            $user->setCreationDate(time());

            // Randomly associate user with entities
            $randomEntity = $faker->randomElement(['Doctor', 'Patient', 'Secretary']);
            switch ($randomEntity) {
                case 'Doctor':
                    $doctor = new Doctor();
                    // Set Doctor properties
                    $doctor->setSpecialty($faker->jobTitle);
                    $doctor->setOfficeRegion($faker->city);
                    $doctor->setOfficeAddress($faker->address);
                    $doctor->setOfficePhone($faker->phoneNumber);

                    // Associate Doctor with User
                    $user->setRoles(['ROLE_DOCTOR']);
                    $doctor->setUser($user);
                    $manager->persist($doctor);
                    break;
                case 'Patient':
                    $patient = new Patient();
                    // Set Patient properties
                    $patient->setRegion($faker->city);

                    // Associate Patient with User
                    $user->setRoles(['ROLE_PATIENT']);
                    $patient->setUser($user);
                    $manager->persist($patient);
                    break;
                case 'Secretary':
                    $secretary = new Secretary();
                    // Set Secretary properties
                    $secretary->setYearExp($faker->numberBetween(1, 10));

                    // Associate Secretary with User
                    $user->setRoles(['ROLE_SECRETARY']);
                    $secretary->setUser($user);
                    $manager->persist($secretary);
                    break;
            }
            $manager->persist($user);
        }

        // Flush objects
        $manager->flush();
    }
}