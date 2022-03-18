<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Event;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventTypeAPI extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Nom de la sortie: '])

            //->add('startDateTime')
            ->add('startDateTime', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Date et heure de la sortie'
            ])


            //->add('endRegisterDate')
            ->add('endRegisterDate', TypeDateType::class, [
                'label' => 'Date limite d\'insciption ',
                'html5' => true,
                'widget' => 'single_text',
                'required' => false,
            ])

            ->add('duration', null, [
                'label' => 'Durée (en minutes): ',
                'attr' => [
                    'min' => 5,
                    'max' => 10080
                ],

            ])

            ->add('nbParticipantMax', null, [
                'label' => 'Nombre de places: ',
                'attr' => [
                    'min' => 2,
                    'max' => 999
                ],

            ])

            ->add('details', TextareaType::class, ['label' => 'Description et infos: '])
            //->add('state')

            ->add(
                'location',
                EntityType::class,
                [
                    'mapped' => true,
                    'class' => Location::class,
                    'choice_label' => 'name'
                ]
            )
            ->add('campus')

            ->add(
                'city',
                EntityType::class,
                [
                    'mapped' => false,
                    'class' => City::class,
                    'choice_label' => 'name',
                    'placeholder' => "Choisir une ville",
                    'required' => true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
