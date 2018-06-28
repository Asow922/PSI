<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KartaPrzedmiotuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wersja', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('studium', null, [
//                'attr' => array(
//                    'class' => 'form-control',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
            ->add('opiekunPrzedmiotu', null, [
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('jezyk', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('wydzial', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('narzedziaDydaktyczne', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('ocenaOsiagniecia', TextareaType::class, [
                'required' => false,
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
            ->add('celePrzedmiotu', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('tresciProgramowe', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('literaturaPodstawowa', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
            ->add('literaturaUzupelniajaca', TextareaType::class, [
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('efektPrzedmiotowy', null, [
//                'attr' => array(
//                    'class' => 'form-control',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
            ->add('programKsztalcenia', null, [
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ),
            ])
//            ->add('przedmiot', null, [
//                'attr' => array(
//                    'class' => 'form-control',
//                    'style' => 'margin-bottom:15px'
//                ),
//            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\KartaPrzedmiotu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_kartaprzedmiotu';
    }


}
