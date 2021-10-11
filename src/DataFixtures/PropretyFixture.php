<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Proprety;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropretyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create('fr_FR');
for($i = 0; $i<200; $i++)
{
    $proprety= new Proprety();
    $proprety
    ->setTitle($faker->words(3, true))
    ->setDescription($faker->sentences(3, true))
    ->setSurface($faker->numberBetween(20,350))
    ->setRooms($faker->numberBetween(2, 10))
    ->setBedrooms($faker->numberBetween(1, 9))
    ->setFloor($faker->numberBetween(0, 15))
    ->setPrice($faker->numberBetween(100000, 1000000))
    ->setHeat($faker->numberBetween(0, count( Proprety::HEAT ) - 1))
    ->setCity($faker->city)
    ->setAdress($faker->address)
    ->setPostalCode($faker->postcode)
    ->setSold(false);
    $manager->persist($proprety);
}

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
