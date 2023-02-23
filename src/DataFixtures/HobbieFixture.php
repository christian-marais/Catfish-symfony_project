<?php

namespace App\DataFixtures;

use App\Entity\Hobbie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HobbieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        {   $data=[
            'natation',
            'écriture',
            'lecture',
            'running',
            'shopping'
        ];
            for($i=0;$i<count($data);$i++){
                $hobbie= new Hobbie;
                $hobbie->setDésignation($data[$i]);
                $manager->persist($hobbie);
            }
            $manager->flush();
        }

    }
}
