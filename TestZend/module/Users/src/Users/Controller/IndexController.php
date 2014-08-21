<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    //map to login
    public function loginAction()
    {
        $view = new ViewModel();
        $view->setTemplate('Users/index/login');
        return $view;
    }
    //map to register
    public function registerAction()
    {
        $view = new ViewModel();
        $view->setTemplate('Users/index/register');
        return $view;
    }
}
