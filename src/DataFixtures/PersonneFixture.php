<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonneFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker= Factory::create(locale:'fr_FR');
        for($i=0;$i<20;$i++){

            $personne = new Personne();
            $personne->setFirstname(firstname:$faker->firstName);
            $personne->setName(name:$faker->lastName);
            $personne->setAge(age:$faker->numberBetween(18,60));

            $manager->persist($personne);

        }
        $manager->flush();
    }
}
