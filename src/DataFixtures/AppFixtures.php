<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Day;
use App\Entity\Blog;
use App\Entity\Hour;
use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Secretary;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        // Instanciate Faker
        $faker = Factory::create('fr_FR');

        // Create Admin
        $user = new User();
        $user->setEmail("admin@admin.com");
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                'admin' // Set a default password, you might want to use a better approach for passwords
            )
        );            $user->setFirstName($faker->firstName);
        $user->setLastName($faker->lastName);
        $user->setPhone($faker->phoneNumber);
        $user->setGender($faker->boolean);
        $user->setBirthdate($faker->dateTimeThisCentury->getTimestamp());
        $user->setCreationDate(time());
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);


        // Create Users and associate with entities
        for ($i = 0; $i < 10; $i++) {
            // Create User
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword(
                $this->passwordHasher->hashPassword(
                    $user,
                    'password' // Set a default password, you might want to use a better approach for passwords
                )
            );            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setPhone($faker->phoneNumber);
            $user->setGender($faker->boolean);
            $user->setBirthdate($faker->dateTimeThisCentury->getTimestamp());
            $user->setCreationDate(time());

            // Randomly associate user with entities
            $randomEntity = $faker->randomElement(['Doctor', 'Patient'/*, 'Secretary'*/]);
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

                    for ($i = 0; $i < 7; $i++) {
                        $blog = new Blog();
                        $blog->setDoctor($doctor); // Assuming $doctor is defined and holds a valid value
                        $timestamp = time();
                        $blog->setCreationDate($timestamp);
                    
                        // Generate random title options:
                        $titleOptions = [
                            $faker->sentence(3, true), // Sentence with 3 words
                            $faker->words(5, true),      // 5 random words (no punctuation)
                            $faker->catchPhrase,        // Catchy phrase
                            $faker->realText(20, 2),     // Random paragraph with 20 words, minimum 2 sentences
                        ];
                    
                        // Pick a random option from the array:
                        $randomTitle = $titleOptions[array_rand($titleOptions)];
                    
                        $blog->setTitle($randomTitle);
                        $blog->setDetails($faker->paragraph); // Set the details using faker
                    
                        $manager->persist($blog); // Assuming $manager is an object with a persist() method
                    }

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

        $currentYear = (int) date('Y');
        $daysInYear = (int) date('z', mktime(0, 0, 0, 12, 31, $currentYear)) + 1;

        for ($i = 1; $i <= $daysInYear; $i++) {
            $day = new Day();
            $day->setDay($i);
            $manager->persist($day);
        }


        // Loop through hours
        for ($i = 0; $i <= 23; $i++) {
            // Loop through minutes
            for ($j = 0; $j <= 59; $j++) {
                // Create new Hour object
                $hour = new Hour();
                
                // Format hour and minute strings
                $hourStr = sprintf("%02d:%02d", $i, $j);
                
                // Set start time for the hour object
                $hour->setStartTime($hourStr);
                
                $manager->persist($hour);
            }
        }

        // Flush objects
        $manager->flush();
    }
}