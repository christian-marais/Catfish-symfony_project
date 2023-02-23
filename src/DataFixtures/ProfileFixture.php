<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $data = [
            'WhatsApp'=>'www.whatsapp.com',
            'Facebook'=>'www.facebook.com',
            'Instagram'=>'www.instagram.com'
        ];
        
        foreach($data as $key => $value){
            $profile= new Profile();
            $profile->setUrl($value);
            $profile->setReseauSocial($key);
            $manager->persist($profile);
        }
        $manager->flush();
    }
}
