<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $data=[
        'menuisier',
        'plombier',
        'avocat',
        'artiste',
        'écrivain',
        'dentiste'
    ];
        for($i=0;$i<count($data);$i++){
            $job= new Job;
            $job->setDésignation($data[$i]);
            $manager->persist($job);
        }
        $manager->flush();
    }
}
