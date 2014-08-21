<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Users\Forms;
use Zend\InputFilter\InputFilter;
class RegisterFilter extends InputFilter
{
    public function __construct($name = null)
    {
        //Email address
        $this->add(array(
                'name' => 'email',
                'required' => true,
                'validators' => array(
                                    array(
                                    'name' => 'EmailAddress',
                                    'options' => array(
                                        'domain' => true,
                                        ),
                                    ),
                                ),
                ));
        $this->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                        array(
                        'name' => 'StripTags',
                            ),
                        ),
            'validators' => array(
                                array(
                                    'name' => 'StringLength',
                                    'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 2,
                                    'max' => 140,
                                    ),
                                ),
                            ),
            ));
        //Password
        $this->add(array(
                        'name' => 'password',
                        'required' => true,
                )       );
        //Confirm Password
         $this->add(array(
                        'name' => 'cPassword',
                        'required' => true,
                )       );
        
    }
}