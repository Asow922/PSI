<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramStudiowType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('liczbaSemestrow', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('wymaganiaWstepne', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('mozliwoscKontynuacji', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('sylwetkaAbsolwenta', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('misjaUczelni', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('analizaZgodnosci', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('programKsztalcenia', null, [
//                'attr' => array(
//                    'class' => 'form-control',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
//            ->add('planStudiow', null, [
//                'attr' => array(
//                    'class' => 'form-control',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
            ->add('modulKsztalcenia', null, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\ProgramStudiow'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_programstudiow';
    }


}
