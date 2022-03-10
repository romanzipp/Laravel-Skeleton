<?php

namespace Support\Vendor\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\CommonMark\Renderer\Inline\ImageRenderer;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class ImageExtension implements ConfigurableExtensionInterface
{
    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('image_caption', Expect::structure([
            'enable' => Expect::bool(true),
        ]));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addRenderer(
            Image::class,
            new ImageRenderer(),
            10
        );
    }
}
