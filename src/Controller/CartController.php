<?php

namespace App\Controller;

use App\Entity\CartProduct;
use App\Entity\Product;
use App\Repository\CartProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    private Serializer $serializer;
    private ?\App\Entity\User $user;
    private EntityManagerInterface $em;
    private CartProductRepository $cartProductRepository;

    public function __construct(UserRepository $userRepository, CartProductRepository $cartProductRepository,EntityManagerInterface $em){
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
        $this->user = $userRepository->find(3);
        $this->em = $em;
        $this->cartProductRepository = $cartProductRepository;

    }

    #[Route("/")]
    public function index(): Response
    {
        return $this->json($this->serializer->serialize($this->user->getCart()->getCartProducts(), "json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['carts', "cart", "category"]]));
    }

    #[Route("/add/{id}/{quantity}")]
    public function addToCart(Product $product, int $quantity) {
        $cart = $this->user->getCart();
        if($cart->getCartProducts()->contains($product)){
            $cartProduct = (new CartProduct())->setProduct($product)->setQuantity($quantity)->setCart($cart);
            $this->em->persist($cartProduct);
        }
        else{
            $cartProduct = $this->cartProductRepository->findOneBy(["product" => $product->getId()]);
            $cartProduct->setQuantity($cartProduct->getQuantity()  + $quantity);
        }
        $this->em->flush();


        return $this->index();
    }
}
