<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        
        $service = ['Comptabilité', 'Ressources-humaines', 'Direction', 'Communication', 'Développement', 'Commercial'];
        
        for ($i = 0; $i < count($service); $i++)
        {
            $department = new Department;
            $department->setName($service[$i]);
            $department->setManager($faker->name());
            $department->setEmail($faker->email());

            $manager->persist($department);
        }

        $manager->flush();
    }
}
