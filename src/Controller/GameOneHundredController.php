<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dice\Dice;
use App\Dice\GameOneHundred;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Notice! Symfony evaluates the routes(i.e. the path of a route)
 * in the order they are defined.
*/

/**
 * Below row to make all routes defined in the class start with
 * path/URL '/gameonehundred' and name 'game_one_hundred':
 */
#[Route('/gameonehundred', name: 'game_one_hundred_', methods: 'GET')]
class GameOneHundredController extends AbstractController
{
    /**
     * @var RequestStack $requestStack The requestStack service object needed for getting the session
     */
    // private $message;
    private $requestStack;

    /**
     * Constructor for initiating an object of the class GameOneHundredController.
     * The constructor is not necessary for being able to create an object of the class.
     * 2021-11-07: Is below row necessary since it´s a service???
     * @param RequestStack $requestStack The requestStack service object injected into the class
     * @return void
     */
    public function __construct(RequestStack $requestStack)
    {
        // $this->message = "Unit testing the GameOneHundredController class is working!";
        $this->requestStack = $requestStack;
    }


    #[Route('/', name: 'start_game')]
    /**
     * @return RedirectResponse
     */
    public function startGame(): RedirectResponse
    {
        // return $this->redirectToRoute('game_one_hundred_index');
        return $this->redirectToRoute('game_one_hundred_index', [], 301);
    }

    #[Route('/index', name: 'index')]
    /**
     * @return Response
     */
    public function index(): Response
    {
        $title = "Dice 100 game";

        return $this->render('game_one_hundred/index.html.twig', [
            'title' => $title,
            'route_name_of_controller' => 'index',
        ]);
    }

    #[Route('/init', name: 'init', methods: 'GET')]
    /**
     * @return Response
     */
    // public function init(RequestStack $requestStack): Response
    public function init(): Response
    {
        $title = "Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        // Get current values from session:
        $currentPlayer = $session->get('currentPlayer');
        $playerRes = $session->get('playerRes');
        $computerRes = $session->get('computerRes');

        $session->set('currentPlayer', null);
        $session->set('playerRes', null);
        $session->set('computerRes', null);
        $session->set('lastRollComputer', null);

        return $this->render('game_one_hundred/init.html.twig', [
            'current_player' => $currentPlayer,
            'player_res' => $playerRes,
            'computer_res' => $computerRes,
            'title' => $title
        ]);
    }

    #[Route('/init-roll', name: 'init_roll', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    // public function initRoll(RequestStack $requestStack): RedirectResponse
    public function initRoll(): RedirectResponse
    {
        // $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        $gameOneHundredA = new GameOneHundred();

        $playerInitDie = new Dice();
        $playerInitDie->rollDice();
        $playerRes = $playerInitDie->getLastRollFaceDice();
        $session->set('playerRes', $playerRes);

        $computerInitDie = new Dice();
        $computerInitDie->rollDice();
        $computerRes = $computerInitDie->getLastRollFaceDice();

        $computerRes = $computerInitDie->getInitRollFaceDice($playerRes, $computerRes);

        $session->set('computerRes', $computerRes);

        $gameOneHundredA->setInitCurrPlayerGame($playerRes, $computerRes);
        $currentPlayer = $gameOneHundredA->getCurrentPlayerGame();

        $session->set('currentPlayer', $currentPlayer);

        // $gameOneHundred = new GameOneHundred($currentPlayer);
        $gameOneHundred = new GameOneHundred(currentPlayer: $currentPlayer);
        $session->set('gameOneHundred', $gameOneHundred);

        // return $this->redirectToRoute('app_gameonehundred_init');
        // return $this->redirectToRoute('game_one_hundred_init_view');
        return $this->redirectToRoute('game_one_hundred_init', [], 301);
    }

    #[Route('/play', name: 'play', methods: 'GET')]
    /**
     * @return Response
     */
     // public function play(RequestStack $requestStack): Response
    public function play(): Response
    {
        $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        $lastRollComputer = $session->get('lastRollComputer', null);
        $gameOneHundred = $session->get('gameOneHundred', null);
        $gameOneHundred->rollGame();
        // Set the round score:
        $gameOneHundred->setRoundScoreGame();
        // $gameOneHundred->setTotDiceFacesGame();

        $data = [ //data to send to the template-file
            "title" => $title,
            "current_player" => $gameOneHundred->getCurrentPlayerGame(),
            "tot_score_player" => $gameOneHundred->getTotScorePlayer(),
            "tot_score_computer" => $gameOneHundred->getTotScoreComputer(),
            "game_one_hundred" => $gameOneHundred,
            "dice_values" => $gameOneHundred->getDiceFacesGame(),
            "round_score" => $gameOneHundred->getRoundScoreGame(),
            "game_over" => $gameOneHundred->gameOver(),
            "last_roll_computer" => $lastRollComputer
        ];

        $session->set('currentPlayer', null);
        $session->set('playerRes', null);
        $session->set('computerRes', null);

        // return $this->render('gameonehundred/play_result.html.twig', $data);
        return $this->render('game_one_hundred/play.html.twig', $data);
    }

    #[Route('/save', name: 'save', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    // public function save(RequestStack $requestStack): RedirectResponse
    public function save(): RedirectResponse
    {
        // $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        // Deal with session variables:
        $gameOneHundred = $session->get('gameOneHundred', null);

        // Set the total score of the current player:
        $gameOneHundred->setTotScoreGame();

        // Get the faces of last roll and save it in the session:
        $session->set('lastRollComputer', $gameOneHundred->getDiceFacesGame());

        $gameOver = $gameOneHundred->gameOver();

        $gameOneHundred->changeCurrentPlayerGame();

        // $totScorePlayer = $gameOneHundred->getTotScorePlayer();
        // echo $totScorePlayer;
        // $totScoreComputer = $gameOneHundred->getTotScoreComputer();
        // echo $totScoreComputer;
        $currentPlayer = $gameOneHundred->getCurrentPlayerGame();

        // $data = [ //data to send to the view-file
        //     "currentPlayer" => $currentPlayer,
        //     "totScorePlayer" => $totScorePlayer,
        //     "totScoreComputer" => $totScoreComputer
        // ];

        //Test 211027:
            $returnRoute = ($gameOver != null)
                ? 'game_one_hundred_win'
                : (($currentPlayer == "Computer")
                ? 'game_one_hundred_init_play_computer'
                : 'game_one_hundred_play');

        return $this->redirectToRoute($returnRoute, [], 301);
        //End test 211027
    }

    #[Route('/init-play-computer', name: 'init_play_computer', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    // public function initPlayComputer(RequestStack $requestStack): RedirectResponse
    public function initPlayComputer(): RedirectResponse
    {
        // $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        $gameOneHundred = $session->get('gameOneHundred', null);

        $gameOneHundred->computerPlay();

        return $this->redirectToRoute('game_one_hundred_save', [], 301);
    }

    #[Route('/play-computer', name: 'play_computer', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    // public function playComputer(RequestStack $requestStack): RedirectResponse
    public function playComputer(): RedirectResponse
    {
        // $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        $gameOneHundred = $session->get('gameOneHundred', null);
        $gameOneHundred->changeCurrentPlayerGame();

        $gameOneHundred->computerPlay();

        return $this->redirectToRoute('game_one_hundred_save', [], 301);
    }

    #[Route('/win', name: 'win', methods: 'GET')]
    /**
     * @return Response
     */
    // public function win(RequestStack $requestStack): Response
    public function win(): Response
    {
        $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        $gameOneHundred = $session->get('gameOneHundred', null);
        $lastRollComputer = $session->get('lastRollComputer', null);

        $data = [ //data to send to the template-file
            "title" => $title,
            "tot_score_player" => $gameOneHundred->getTotScorePlayer(),
            "tot_score_computer" => $gameOneHundred->getTotScoreComputer(),
            "game_over" => $gameOneHundred->gameOver(),
            "last_roll_computer" => $lastRollComputer
        ];

        return $this->render('game_one_hundred/win.html.twig', $data);
    }

    #[Route('/restart-init', name: 'restart_init', methods: 'GET')]
    /**
     * @return RedirectResponse
     */
    // public function restartInit(RequestStack $requestStack): RedirectResponse
    public function restartInit(): RedirectResponse
    {
        // $title = "Play the Dice 100 game";
        // $session = $requestStack->getSession();
        $session = $this->requestStack->getSession();

        $session->set('playerRes', null);
        $session->set('computerRes', null);
        $session->set('currentPlayer', null);
        $session->set('gameOneHundred', null);
        $session->set('lastRollComputer', null);

        return $this->redirectToRoute('game_one_hundred_init', [], 301);
    }

    #[Route('/{wcard}', name: 'wcard', methods: 'GET')]
    /**
     * @return Response
     */
    // public function gameWcard(Request $request, string $wcard): Response
    public function gameWcard(string $wcard): Response
    {
        // $routeName = 'game_one_hundred_index';
        //
        // return $this->render('bundles/TwigBundle/Exception/error404.html.twig', [
        //     'routeName' => $routeName,
        // ]);

        // $data = [
        //     'routeName' => 'game_one_hundred_index'
        // ];

        // $data = [
        //     'route_name_of_controller' => 'wcard',
        //     'route_name_for_url_app' => 'start',
        //     'route_name_for_url_game_100' => 'game_one_hundred_index'
        // ];

        $data = [
            'route_parameters' => $this->requestStack
                ->getCurrentRequest()->attributes
                ->get('_route_params'),
            'invalid_path' => $wcard,
            'route_name_of_controller' => 'invalid_path',
            'route_name_for_url_app' => 'start_index',
            'route_name_for_url_game_100' => 'game_one_hundred_index'
        ];

        return $this->render('bundles/TwigBundle/Exception/error404.html.twig', $data);
    }
}
