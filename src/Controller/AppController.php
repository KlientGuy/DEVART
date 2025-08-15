<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

#[Route('/{_locale}', locale: 'pl', defaults: ['_locale' => 'pl'], requirements: ['_locale' => '|pl|en|de'])]
class AppController extends AbstractController
{

    private const PORTFOLIO_MAP = [
        'biuroland' => ['site' => 'biuroland.html.twig', 'cat' => 'web'],
        'fashion' => ['site' => 'fashion.html.twig', 'cat' => 'fashion'],
        'foco' => ['site' => 'foco.html.twig', 'cat' => 'brand'],
        'forest' => ['site' => 'forest.html.twig', 'cat' => 'pack'],
        'merceria' => ['site' => 'merceria.html.twig', 'cat' => 'web'],
        'prelitech' => ['site' => 'prelitech.html.twig', 'cat' => 'pack'],
        'tukuptu' => ['site' => 'sahur.html.twig', 'cat' => 'web'],
        'skawina' => ['site' => 'skawina.html.twig', 'cat' => 'web'],
        'socialmedia' => ['site' => 'socialmedia.html.twig', 'cat' => 'social'],
        'stockholm' => ['site' => 'stockholm.html.twig', 'cat' => 'fashion'],
        'gopr' => ['site' => 'gopr.html.twig', 'cat' => 'web'],
        'optident' => ['site' => 'optident.html.twig', 'cat' => 'web']
    ];

    public function __construct(private readonly RouterInterface $router) {}

    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index()
    {
        return $this->render('app/index.html.twig');
    }

    #[Route('/offer', name: 'app_offer', methods: ['GET'])]
    public function offer()
    {
        return $this->render('app/offer.html.twig');
    }

    #[Route('/portfolio/', name: 'app_portfolio', methods: ['GET'])]
    public function portfolio(Request $request)
    {
        $cat = $request->query->get('filter');
        return $this->render('app/portfolio.html.twig', ['main' => true, 'cat' => $cat ?? 'all', 'filter' => !empty($cat)]);
    }

    #[Route('/portfolio/{site}', name: 'app_portfolio_single', methods: ['GET'])]
    public function portfolioSingle(string $site) 
    {
        $template = self::PORTFOLIO_MAP[$site] ?? null;

        if(empty($template))
            return $this->redirect($this->router->generate('app_portfolio'));

        return $this->render("app/portfolio.html.twig", [
            'site' => $template['site'],
            'cat' => $template['cat'],
            'main' => false
        ]);
    }

    #[Route('/business-card', name: 'business_card')]
    public function businessCard(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('business_card/business_card.html.twig');
    }
}
