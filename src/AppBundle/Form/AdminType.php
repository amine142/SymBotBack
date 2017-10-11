<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Form\Type\RegistrationFormType;

/**
 * Form Admin
 *
 * @author amine <amine@local.me>
 */
class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',           TextType::class, [
                'label' => 'admin.firstname',
                'constraints'       => [
                     new Assert\NotBlank(),
                ],
            ])
            ->add('lastname',           TextType::class, [
                'label' => 'admin.lastname',
                'constraints'       => [
                     new Assert\NotBlank(),
                ],
            ])
            ->add('roles',           ChoiceType::class, [
                'label' => 'role',
                'constraints' => [
                     new Assert\NotBlank(),
                ],
                'choices'  => array(
                    'Admin' => 'ROLE_ADMIN',
                    'Super admin' => 'ROLE_SUPERADMIN',
                ),
                'multiple' => true,
            ])
            ->add('save',      			SubmitType::class, [
                'label'             => 'Save',
                'attr'              => [
                    'class'     => 'btn btn-primary'
                ]
            ]);
    }

    public function getParent()
    {
        return RegistrationFormType::class;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\\Document\\Admin'
        ));
    }

    public function getName() 
    {
        return 'register_admin';
    }

}
