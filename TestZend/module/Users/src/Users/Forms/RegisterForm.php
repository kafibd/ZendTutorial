<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Users\Forms;
use Zend\Form\Form;
class RegisterForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Register');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/formdata');
        // All fields are added to the form using the $this->add() method on the
        //form's constructor:
        $this->add(array(
                        'name' => 'name',
                        'attributes' => array(
                                            'type' => 'text',
                                            ),
                        'options' => array(
                                        'label' => 'Full Name',
                                        ),
                        )
                    );
        //3. Additional validators/filters can be added to the fields while declaring
        //the fields in the form. In this case we are adding special validation for
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
        //For confirm password
        $this->add(array(
                        'name' => 'cPassword',
                        'attributes' => array(
                                            'type' => 'password',
                                            ),
                        'options' => array(
                                        'label' => 'Confirm Password',
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