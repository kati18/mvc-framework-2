<?php

namespace App\Controller;

use App\Entity\HighScore;
use App\Repository\HighScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/high-score', name: 'high_score_', methods: 'GET')]
class HighScoreController extends AbstractController
{
    // #[Route('/high/score', name: 'high_score')]
    // public function index(): Response
    // {
    //     return $this->render('high_score/index.html.twig', [
    //         'controller_name' => 'HighScoreController',
    //     ]);
    // }

    #[Route('/create/{score}/{winner}', name: 'create')]
    public function createHighScore(int $score, string $winner, EntityManagerInterface $entityManager): Response
    {
        $highScore = new HighScore();
        $highScore->setWinner($winner);
        $highScore->setScore($score);
        $highScore->setDate(date("Y-m-d H:i:s"));

        $entityManager->persist($highScore);
        $entityManager->flush();

        // Test 211125 kl. 14:00:
        $highScoreListUrl = $this->generateUrl('high_score_find_all');
        return new Response('The total score of the winner is saved into the' . "<a href='$highScoreListUrl'>highscore list</a>");
        // return new Response('The total score of the winner is saved into the highscore list.' . $highScoreListUrl);
        // End test 211125 kl. 14:00:

        // Outcommented 211125 kl 14:00:
        // return new Response('Saved new highscore with id' . $highScore->getId());
        // return new Response('The total score of the winner is saved into the highscore list.');
        // End outcommented 211125 kl 14:00:

        // // Below prints the actual point in time i.e. 2021-11-23 09:32:03:
        // $date = date("Y-m-d H:i:s");
        //
        // return $this->render('high_score/index.html.twig', [
        //     'controller_name' => 'HighScoreController',
        //     'route_name_of_controller' => 'high_score_create',
        //     'score' => $score,
        //     'winner' => $winner,
        //     'date' => $date,
        // ]);
    }

    #[Route('/find/all', name: 'find_all')]
    public function fetchAllHighScores(HighScoreRepository $highScoreRepository): Response
    {
        $highScores = $highScoreRepository->findAll();

        // if (empty($highScores)) {
        //     return new Response(
        //         "No data found",
        //         Response::HTTP_NOT_FOUND,
        //         ['content-type' => 'text/plain']
        //     );
        // }

        return $this->render('high_score/index.html.twig', [
            'controller_name' => 'HighScoreController',
            'route_name_of_controller' => 'high_score_find_all',
            'high_scores' => $highScores,
        ]);
    }
}
