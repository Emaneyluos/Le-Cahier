<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Classe;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateValidite', DateType::class, [
                'required' => false,
                'widget' => 'single_text'
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'nom',
            ])
            ->add('codeProfesseur', NumberType::class, [
                'mapped' => false,
            ])
            ->add('question', TextType::class)
            ->add('reponse', TextType::class)
            // If you want to add fields for DateReponses, you need to handle it here as well.
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
