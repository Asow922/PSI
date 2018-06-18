<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramStudiowType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('liczbaSemestrow')->add('wymaganiaWstepne')->add('mozliwoscKontynuacji')->add('sylwetkaAbsolwenta')->add('misjaUczelni')->add('analizaZgodnosci')->add('programKsztalcenia')->add('planStudiow')->add('modulKsztalcenia');
    }/**
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
