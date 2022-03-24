<?php

namespace App\Controller;

use App\Entity\CartProduct;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CartProductRepository;
use App\Repository\ProductCartRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    private ?User $user;
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

    /**
     * Return all product in user's cart
     * @return Response
     */
    #[Route("/", name: "all")]
    public function index(): Response
    {
        return $this->json($this->serializer->serialize($this->user->getCart()->getCartProducts(), "json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['carts', "cart", "category"]]));
    }

    /**
     * Add product with quantity to user's cart
     * @param Product $product
     * @param int $quantity
     * @return Response
     */
    #[Route("/add/{id}/{quantity}", name: "add")]
    public function addToCart(Product $product, int $quantity): Response
    {
        $cart = $this->user->getCart();
        if($quantity > $product->getStock()){
            $product->setStock(0);
        }
        else{
            $product->setStock($product->getStock() - $quantity);
        }
        if($cart->getCartProducts()->contains($product)){
            $cartProduct = (new CartProduct())->setProduct($product)->setQuantity($quantity)->setCart($cart);
            $this->em->persist($cartProduct);
        }
        else{
            $cartProduct = $this->cartProductRepository->findOneBy(["product" => $product->getId()]);
            $cartProduct->setQuantity($cartProduct->getQuantity()  + $quantity);
        }
        $this->em->flush();


        return $this->json(["success" => true]);
    }

    /**
     * Remove product from user's cart
     * @return JsonResponse
     */
    #[Route("/remove/{id}", name: "remove")]
    public function removeProductFromCart(Product $product): Response
    {
        $cart = $this->user->getCart();
        $productCart = $this->cartProductRepository->findBy(["product" => $product->getId(), "cart" => $cart->getId()])[0];
        $product->setStock($product->getStock() + $productCart->getQuantity());
        $productCart->setQuantity(0);
        $this->em->flush();

        return $this->json(["success" => true]);
    }
}
