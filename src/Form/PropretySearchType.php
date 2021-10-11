<?php

namespace App\Form;



use App\Entity\Option;
use App\Entity\PropretySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class PropretySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class,
            [
                'required' =>false,
                'label' =>false,
                'attr' =>['placeholder' =>'Budget max']
            ])
            ->add('minSurface', IntegerType::class,
            [
                'required' =>false,
                'label' =>false,
                'attr' =>['placeholder' =>'Surface minimale']
            ])
            ->add('options', EntityType::class,
            [
                'required'=>false,
                'label' =>false,
                'class' =>Option::class,
                'choice_label'=>'name',
                'multiple'=> true
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropretySearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

public function getBlockPrefix()
{
    return '';
}



}
