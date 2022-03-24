<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++){
            $category = new Category();
            $category->setName("category " . $i);
            $manager->persist($category);
        }
        $manager->flush();

        $cart = new Cart();
        $manager->persist($cart);

        $user = new User();
        $user
            ->setName("user 1")
            ->setCart($cart);
        $manager->persist($user);


        $manager->persist($user);

        for($i = 0; $i < 5; $i++){
            $product = new Product();
            $product->setCategory($this->categoryRepository->getRandom())
                ->setTitle("product-" . uniqid())
                ->setPrice(random_int(1,1000))
                ->setDescription("description for product " . $i)
                ->setStock(random_int(0,20))
                ->setImage("image" . $i+1 . ".png");


            $manager->persist($product);
        }


        $manager->flush();
    }
}
