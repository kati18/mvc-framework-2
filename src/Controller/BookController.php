<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book_', methods: 'GET')]
class BookController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'route_name_of_controller' => 'book_index',
        ]);
    }

    #[Route('/all', name: 'all')]
    public function fetchAllBooks(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        // if (empty($books)) {
        //     return new Response(
        //         "No data found",
        //         Response::HTTP_NOT_FOUND,
        //         ['content-type' => 'text/plain']
        //     );
        // }

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'route_name_of_controller' => 'book_all',
            'books' => $books,
        ]);
    }
}
