<?php

namespace Support\Vendor\CommonMark;

use League\CommonMark\Extension\CommonMark\Renderer\Inline\ImageRenderer as BaseRenderer;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\Config\ConfigurationInterface;

class ImageRenderer implements NodeRendererInterface
{
    protected ConfigurationInterface $config;

    protected BaseRenderer $baseImageRenderer;

    public function __construct(ConfigurationInterface $config, BaseRenderer $baseImageRenderer)
    {
        $this->config = $config;
        $this->baseImageRenderer = $baseImageRenderer;
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        $stripSrc = $this->config->get('lazy_image/strip_src');
        $dataAttribute = $this->config->get('lazy_image/data_attribute');
        $htmlClass = $this->config->get('lazy_image/html_class');

        $this->baseImageRenderer->setConfiguration($this->config);
        /** @var \League\CommonMark\Util\HtmlElement $htmlElement */
        $htmlElement = $this->baseImageRenderer->render($node, $childRenderer);

        $htmlElement->setAttribute('loading', 'lazy');

        if ($dataAttribute) {
            $htmlElement->setAttribute("data-$dataAttribute", $htmlElement->getAttribute('src'));
        }

        if ($htmlClass) {
            // append the class to existing classes
            $attr = $htmlElement->getAttribute('class');
            if ( ! empty($attr)) {
                $attr .= ' ';
            }
            $attr .= $htmlClass;
            $htmlElement->setAttribute('class', $attr);
        }

        if ($stripSrc) {
            $htmlElement->setAttribute('src', '');
        }

        return $htmlElement;
    }
}
