<?php

namespace ModelBundle\Form;

use ModelBundle\Entity\Enum\ProfilKsztalcenia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EfektMinisterialnyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identyfikator', TextType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('opis', TextareaType::class, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('obszar', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('profil', EntityType::class, [
                    'class' => ProfilKsztalcenia::class,
                    'expanded' => true,
                ]
            )
            ->add('poziom', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('zakres', null, [
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
            'data_class' => 'ModelBundle\Entity\EfektMinisterialny'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_efektministerialny';
    }


}
