<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\SalleDeClasse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleDeClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('capacite')
            ->add('localisation')
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SalleDeClasse::class,
        ]);
    }
}
