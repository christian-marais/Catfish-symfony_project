<?php

namespace App\Form;

use App\Entity\Hobbie;
use App\Entity\Personne;
use App\Entity\Profile;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('name')
            ->add('age')
            ->add('createdAt')
            ->add('updatedAt')
            ->add(
                'profile',
                EntityType::class,
                ['expanded'=>true,
                'class'=> Profile::class,
                 'multiple'=>false])
            ->add(child:'hobbies',type:EntityType::class,options:[
            'class'=>Hobbie::class,
            'expanded'=>true,
            'multiple'=>true,
            'query_builder' => function (EntityRepository $er){
                return $er->createQueryBuilder('h')
                    ->orderBy('h.id', 'DESC');
            },'choice_label'=>'Désignation'
            ])
            ->add('job')
            ->add('editer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
