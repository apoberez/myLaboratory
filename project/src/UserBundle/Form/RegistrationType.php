<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 19.04.15
 * Time: 10:28
 */

namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email');
        $builder->add('plainPassword', 'repeated', [
            'first_name' => 'password',
            'second_name' => 'confirm',
            'type' => 'password'
        ]);
        $builder->add('submit', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'registration';
    }
}