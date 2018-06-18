<?php

namespace ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KartaPrzedmiotuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('wersja')->add('studium')->add('opiekunPrzedmiotu')->add('jezyk')->add('wydzial')->add('narzedziaDydaktyczne')->add('ocenaOsiagniecia')->add('wymaganiaWstepne')->add('celePrzedmiotu')->add('tresciProgramowe')->add('literaturaPodstawowa')->add('literaturaUzupelniajaca')->add('efektPrzedmiotowy')->add('przedmiot');
    }/**
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
