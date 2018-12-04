<?php

namespace App\DataFixtures;




use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    private const categories = ['tome1','tome2','tome3','tome4','tome5'];

    public function load(ObjectManager $manager)
    {
        foreach (self::categories as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);

        }

        $manager->flush();
    }
}