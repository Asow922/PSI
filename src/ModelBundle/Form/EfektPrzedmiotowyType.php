<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class EfektPrzedmiotowyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identyfikator', TextType::class, [
                'attr' => array(
                    'pattern' => '[A-Z]{3}_[U,W,K]\d{2}',
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('opis', null, [
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
            ])
            ->add('efektKierunkowy', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control select2',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('kartaPrzedmiotu')
//            ->add('profil')
//            ->add('poziom')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\EfektPrzedmiotowy'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_efektprzedmiotowy';
    }


}
