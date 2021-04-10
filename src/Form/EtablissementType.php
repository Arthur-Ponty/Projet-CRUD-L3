<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('appelation_officielle', TextType::class)
            ->add('denomination', TextType::class)
            ->add('secteur',ChoiceType::class, array(
                'expanded' => false,
                'multiple' => false,
                'choices'  => array(
                    'Public' => "Public",
                    'Privée' => "Privée",
                )))
            ->add('longitude', IntegerType::class)
            ->add('latitude', IntegerType::class)
            ->add('adresse', TextType::class, ['required' => false])
            ->add('departement', TextType::class)
            ->add('commune', TextType::class)
            ->add('region', TextType::class)
            ->add('academie', TextType::class)
            ->add('date_ouverture', DateType::Class, array(
                'data' => new \DateTime,
                'format' => 'ddMMyyyy',
                'widget' => 'choice',
                'years' => range(date('Y')-100, date('Y'))
              ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}