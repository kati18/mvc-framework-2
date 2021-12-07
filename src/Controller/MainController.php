<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Notice! Symfony evaluates the routes(i.e. the path of a defined route)
 * in the order they are defined.
*/

class MainController extends AbstractController
{
    // /**
    //  * @var string $message A property for unit tests
    //  */
    // private $message;

    /**
     * Constructor for initiating an object of the class MainController.
     * The constructor is not necessary for being able to create an object of the class.
     * @return void
     */
    public function __construct()
    {
        // $this->message = "Unit testing the MainController class is working!";
    }


    #[Route(path: '/', name: 'start_index', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'main' => 'This is Katja´s first Symfony app ever!',
            'route_name_of_controller' => 'start_index',
        ]);
    }


    #[Route(path: '/me', name: 'me', methods: ['GET', 'HEAD'])]
    public function me(): Response
    {
        return $this->render('main/me.html.twig', [
            'route_name_of_controller' => 'me',
            'heading' => 'Katja Tibe',
            'me' => 'Katjas me-sida från Maincontroller!',
            'more_about_me' => 'Är en på deltid tjänstledig småländsk sjukgymnast och ' .
            'IT-utbildare som när hon inte kämpar med kursen mvc och PHP-ramverket ' .
            'Symfony gärna plockar kantareller och lingon, lagar god mat och ser på film och hockey.'
        ]);
    }


    #[Route(path: '/about', name: 'about', methods: ['GET', 'HEAD'])]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'route_name_of_controller' => 'about',
            'about' => 'Katjas about-sida från Maincontroller!',
        ]);
    }


    #[Route(path: '/{invalidPath}', name: 'invalid_path', methods: ['GET', 'HEAD'])]
    public function invalidPath(Request $request, string $invalidPath): Response
    {
        // echo "request from MainController: \n";
        // echo $request;
        // echo "\n";
        // echo "invalidPath: \n";
        // echo $invalidPath;

        /** Below dumps the $invalidPath variable and the object itself
         * i.e. the object of the class MainController:
         */
        // dump($invalidPath, $this);
        /** Below dumps the $invalidPath variable and the object itself
         * i.e. the object of the class MainController and then kills the page:
         */
        // dd($invalidPath, $this);

        $data = [
            'route_parameters' => $request->attributes->get('_route_params'),
            'invalid_path' => $invalidPath,
            'route_name_of_controller' => 'invalid_path',
            'route_name_for_url_app' => 'start_index',
            'route_name_for_url_game_100' => 'game_one_hundred_index'
        ];

        return $this->render('bundles/TwigBundle/Exception/error404.html.twig', $data);

        // throw $this->createNotFoundException('Katja says something went wrong again!');
    }
}
