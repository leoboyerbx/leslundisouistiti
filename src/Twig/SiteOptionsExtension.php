<?php
namespace App\Twig;

use App\Options\OptionsManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SiteOptionsExtension extends AbstractExtension {
    public function __construct(
        public OptionsManager $options
    ) {}

    public function getFunctions(): array {
        return [
            new TwigFunction('get_option', [$this, 'getOption'])
        ];
    }
    public function getOption(string $optionName): string {
        return $this->options->getOption($optionName);
    }
}
