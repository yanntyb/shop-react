<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/product', name: 'product_')]
class ProductController extends AbstractController
{

    private ProductRepository $repository;
    private Serializer $serializer;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    #[Route('/all', name: 'all')]
    public function index(): Response
    {
        return $this->json($this->serializer->serialize($this->repository->findAll(), "json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['category']]));
    }
}
