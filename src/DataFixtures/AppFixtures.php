<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Company;
use App\Entity\Flight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    protected  $faker;
    public function load(ObjectManager $manager): void
    {
        $companies = ['Airbus', 'EuroCopter', 'Boeing', 'Helicoco'];
        $comp = [];

        foreach ($companies as $companyName) {

            $this->faker = Factory::create();
            $company = new Company();
            $company->setName($companyName);
            $manager->persist($company);
            //worst thing to flush multiple time 
            $manager->flush();
            array_push($comp, $company);
        }
        $limit = $this->faker->numberBetween(30, 150);
        for ($i = 0; $i < $limit; $i++) {
            $flight = new Flight();
            $flight->setDeparture($this->faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years'))
                ->setDestination($this->faker->address)
                ->setGate($this->faker->numberBetween(100, 1000))
                ->setFlightNumber($this->faker->numberBetween(1000, 10000))
                ->setCompany($this->faker->randomElement($comp));
            $manager->persist($flight);
            $manager->flush();
        }
    }
}
