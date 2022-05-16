<?php

namespace App\Form;

use App\DTO\RechercheMulticriteresDTO;
use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheMulticriteresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee', IntegerType::class, ['required'=>false])
            ->add('nom', null, ['required'=>false])
            ->add('acteur', EntityType::class, ['class'=>Casting::class, 'required'=>false])
            ->add('realisateur', EntityType::class, ['class'=>Casting::class, 'required'=>false])
            ->add('pays', EntityType::class, ['class'=>Pays::class, 'required'=>false])
            ->add('genre', EntityType::class, ['class'=>Genre::class, 'required'=>false])
            ->add('Rechercher', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheMulticriteresDTO::class,
        ]);
    }
}
