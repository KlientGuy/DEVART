<?php

namespace App\TwigExtension;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AbsolutePath extends AbstractExtension
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator) {}

    public function getFunctions()
    {
        return [
            new TwigFunction('absolute_path', [$this, 'absoluteUrl'])
        ];
    }

    public function absoluteUrl(string $path, array $params = [])
    {
        return $this->urlGenerator->generate($path, $params, UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
