<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users\Controller;

use Users\Forms\RegisterForm;
use Users\Forms\RegisterFilter;
use Users\Models\User;
use Users\Models\UserTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegisterController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new RegisterForm();
        $viewModel = new ViewModel(array('form' =>$form));
        return $viewModel;
    }
    //
    public function confirmAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('Users/register/confirm');
        return $viewModel;
    }
    //
    public function processAction(){
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL ,array( 
                'controller' => 'register',
                'action' => 'index'
                ));
            }
            $post = $this->request->getPost();
            $form = new RegisterForm();
            $inputFilter = new RegisterFilter();
            $form->setInputFilter($inputFilter);
            $form->setData($post);
            if (!$form->isValid()) {
                $model = new ViewModel(array(
                    'error' => true,
                    'form' => $form,
                ));
                $model->setTemplate('Users/register/index');
                return $model;
            }
            // Create user
            $this->createUser($form->getData());
            return $this->redirect()->toRoute(NULL , array(
                'controller' => 'register',
                'action' => 'confirm'
            ));
    }
    //
    protected function createUser(array $data)
    {
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new
                            \Users\Models\User);
        $tableGateway = new \Zend\Db\TableGateway\TableGateway('user',
                            $dbAdapter, null, $resultSetPrototype);
        $user = new User();
        $user->exchangeArray($data);
        $userTable = new UserTable($tableGateway);
        $userTable->saveUser($user);
        return true;
    }
}
