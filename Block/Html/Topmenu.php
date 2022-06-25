<?php

namespace okysyl\Menu\Block\Html;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\Data\TreeFactory;
use Magento\Framework\View\Element\Template;
use Magento\Theme\Block\Html\Topmenu as NativeTopmenu;

class Topmenu extends NativeTopmenu
{

    /**
     * @param Template\Context $context
     * @param NodeFactory $nodeFactory
     * @param TreeFactory $treeFactory
     * @param \JohnnyWas\Category\Helper\Data $categoryHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        NodeFactory $nodeFactory,
        TreeFactory $treeFactory,
        \KisilOleg\Menu\Helper\Data $categoryHelper,
        array $data = []
    ) {
        $this->categoryHelper = $categoryHelper;
        parent::__construct($context, $nodeFactory, $treeFactory, $data);
    }

    /**
     * Add sub menu HTML code for current menu item
     *
     * @param Node $child
     * @param string $childLevel
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string HTML code
     */

    protected function _addSubMenu($child, $childLevel, $childrenWrapClass, $limit)
    {
        $html = '';
        if (!$child->hasChildren()) {
            return $html;
        }

        $image = $this->categoryHelper->getImageUrl($child->getData('test_menu'));

        $colStops = [];
        if ($childLevel == 0 && $limit) {
            $colStops = $this->_columnBrake($child->getChildren(), $limit);
        }

        $html .= '<ul class="level' . $childLevel . ' ' . $childrenWrapClass . '">';
        $html .= $this->_getHtml($child, $childrenWrapClass, $limit, $colStops);

        if (!empty($image)) {
            $html.= '<div class="image-wrapper"><img src="' . $image . '" alt="Menu Item Image" /></div>';
        }

        $html .= '</ul>';

        return $html;
    }
}
