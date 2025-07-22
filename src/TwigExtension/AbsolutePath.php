<?php

namespace App\TwigExtension;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AbsolutePath extends AbstractExtension
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator, private readonly RequestStack $stack) {}

    public function getFunctions()
    {
        return [
            new TwigFunction('absolute_path', [$this, 'absoluteUrl'])
        ];
    }

    public function absoluteUrl(string $path, array $params = [])
    {
        $request = $this->stack->getMainRequest();
        $attr = $request->attributes->get('_route_params');
        $merged = array_merge($attr, $params);
        return $this->urlGenerator->generate($path, $merged, UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
