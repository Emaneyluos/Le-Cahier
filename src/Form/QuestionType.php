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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeProfesseur', PasswordType::class, [
                'mapped' => false,
                'attr' => ['maxlength' => 6],
            ])
            ->add('dateValidite', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'question-hidden'],
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'nom',
                'attr' => ['class' => 'question-hidden'],
            ])
            ->add('question', TextareaType::class, [
                'attr' => ['class' => 'question-hidden'],
            ])
            ->add('reponse', TextareaType::class, [
                'attr' => ['class' => 'question-hidden'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
