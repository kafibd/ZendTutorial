<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Users\Forms;
use Zend\Form\Form;
class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Login');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/formdata');
        // All fields are added to the form using the $this->add() method on the
        //form's constructor:
        //the EmailAddress field:
        $this->add(array(
                        'name' => 'email',
                        'attributes' => array(
                                              'type' => 'email',
                                            ),
                        'options' => array(
                                            'label' => 'Email',
                                            ),
                        'attributes' => array(
                                            'required' => 'required'
                                            ),
                        'filters' => array(
                                        array('name' => 'StringTrim'),
                                        ),
                        'validators' => array(
                                            array(
                                            'name' => 'EmailAddress',
                                            'options' => array(
                                                            'messages' => 
                                                                array(
                                                                    \Zend\Validator\
                                                                    EmailAddress::INVALID_FORMAT => 'Email address format is
                                                                    invalid'
                                                                    )
                                                                )
                                                )
                                            )
                        )
                );
        //For password
        $this->add(array(
                        'name' => 'password',
                        'attributes' => array(
                                            'type' => 'password',
                                            ),
                        'options' => array(
                                        'label' => 'Password',
                                        ),
                        )
                    );
        //For Submit
        $this->add(array(
                        'name' => 'submit',
                        'attributes' => array(
                                            'type' => 'submit',
                                            'value' => 'submit',
                                            ),
//                        'options' => array(
//                                        'label' => 'Submit',
//                                        ),
                        )
                    );
        
    }
}