<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramKsztalceniaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specjalnosc', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('cykl', DateType::class, [
            ])
            ->add('efektKierunkowy', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('poziom', null, [
                'attr' => array(
                    'class' => 'form-control select2',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('profil', null, [
                'attr' => array(
                    'class' => 'form-control select2',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('tytul', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('obszar', null, [
                'attr' => array(
                    'class' => 'form-control select2',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('jezyk', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('kierunekStudiow', null, [
//                'attr' => array(
//                    'class' => 'form-control select2',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
//            ->add('programStudiow', null, [
//                'attr' => array(
//                    'class' => 'form-control select2',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\ProgramKsztalcenia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_programksztalcenia';
    }


}
