<?php
declare(strict_types=1);

namespace Voronin\Cars\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\FrameWork\View\LayoutInterface;

class MyViewModel implements ArgumentInterface
{
    private $layout;

    public function __construct(LayoutInterface $layout)
    {
        $this->layout = $layout;
    }

    public function getHandles(): array
    {
        return $this->layout->getUpdate()->getHandles();
    }
}
