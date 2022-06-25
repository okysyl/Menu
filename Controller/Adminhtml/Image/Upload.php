<?php

namespace okysyl\Menu\Controller\Adminhtml\Image;

use Magento\Framework\Controller\ResultFactory;

class Upload extends \Magento\Catalog\Controller\Adminhtml\Category\Image\Upload
{
    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $imageName = $this->getRequest()->getParam('test_menu');
            $imageName = isset($imageName) ? $imageName : 'test_menu';
            $result = $this->imageUploader->saveFileToTmpDir($imageName);

            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
