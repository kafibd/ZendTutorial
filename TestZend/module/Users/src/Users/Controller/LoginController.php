<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users\Controller;

use Users\Forms\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    protected $authservice;
    public function indexAction()
    {
        $form = new LoginForm();
        $viewModel = new ViewModel(array('form' =>$form));
        return $viewModel;
    }

    //
    public function processAction()
    {//}
        $this->getAuthService()->getAdapter()->setIdentity(
                $this->request->getPost('email'))->setCredential(
                $this->request->getPost('password'));
        $result = $this->getAuthService()->authenticate();
        if (!$result->isValid()) {
                $post = $this->request->getPost();
                $form = new LoginForm();
                $form->setData($post);
                $model = new ViewModel(array(
                    'error' => true,
                    'form' => $form,
                ));
                $model->setTemplate('Users/Login/index');
                return $model;
            }
        elseif ($result->isValid()) {
            $this->getAuthService()->getStorage()->write(
                    $this->request->getPost('email'));
            return $this->redirect()->toRoute(NULL , array(
                            'controller' => 'Login',
                            'action' => 'confirm'));
        }
    }
    //
    public function confirmAction()
    {
        $user_email = $this->getAuthService()->getStorage()->read();
        $viewModel = new ViewModel(array(
                    'user_email' => $user_email));
        return $viewModel;
    }
    // 
    public function getAuthService()
    {

        if (! $this->authservice) {
            $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter,
            'user','email','password', 'MD5(?)');
            $authService = new AuthenticationService();
            $authService->setAdapter($dbTableAuthAdapter);
            $this->authservice = $authService;
        }
        return $this->authservice;
    }
}
