<?php

namespace ModelBundle\Form;

use ModelBundle\Entity\Enum\FormaKursu;
use ModelBundle\Entity\Enum\Typ;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ects', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('zZU', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('formaKursu', EntityType::class, [
                'class' => FormaKursu::class,
                'expanded' => true,
                'attr' => array(
                    'class' => 'form-check',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('ogolnoUczelniany', null, [
                'label' => 'Ogólnouczelniany',
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('praktyczny', null, [
                'label' => 'O charakterze praktycznym',
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('typ', EntityType::class, [
                'class' => Typ::class,
                'expanded' => true,
                'attr' => array(
                    'class' => 'form-check',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('efektKierunkowy', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control select2',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('przedmiot', null, [
//                'attr' => array(
//                    'class' => 'form-control',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
            ->add('modulKsztalcenia', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('grupaKursow', null, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('forma', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('sposobZaliczenia', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('rodzaj', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\Kurs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_kurs';
    }


}
