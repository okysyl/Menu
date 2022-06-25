<?php

namespace okysyl\Menu\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $storeManager;

    protected $_imageCodes = [
        'menu_image'
    ];

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * Retrieve attribute image URL
     *
     * @return string
     */
    public function getImageUrl($image)
    {
        $url = false;
        if ($image) {
            if (is_string($image)) {
                $url = $this->storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_WEB
                )  . $image;
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }
}
