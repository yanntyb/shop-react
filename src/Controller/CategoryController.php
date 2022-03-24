<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    private CategoryRepository $repository;
    private Serializer $serializer;

    public function __construct(CategoryRepository $repository){
        $this->repository = $repository;
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * Return product
     * @param int $id
     * @return Response
     */
    #[Route("/{id}", name: "single")]
    public function index(int $id): Response
    {
        // If id = 0 then return all product
        if ($id === 0) {
            return $this->json($this->serializer->serialize($this->repository->findAll(), "json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['category']]));
        }
        if ($this->repository->find($id)) {
            return $this->json($this->serializer->serialize($this->repository->find($id), "json", [AbstractNormalizer::IGNORED_ATTRIBUTES => ['category']]));
        }
        return $this->json(["products" => []]);
    }
}
