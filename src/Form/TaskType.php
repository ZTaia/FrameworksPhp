<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Task;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Name",
                'attr' => [
                    'placeholder' => "Enter name",
                ],
                'constraints' => [
                    new Length(
                        min: 5,
                        max: 100,
                        minMessage: 'Your name must be at least {{ limit }} characters long',
                        maxMessage: 'Your name cannot be longer than {{ limit }} characters'
                    ),
                    new Regex(
                        pattern: "/[A-Za-z]*/",
                        message: 'Your name cannot contain a number'

                    ),
                    new NotBlank(
                        message: 'Name cannot be blank'
                    )
                ]
            ])
            ->add('description', TextType::class, [
                'label' => "Description",
                'attr' => [
                    'placeholder' => "Enter Description",
                ],
                'constraints' => [
                    new Length(
                        min: 5,
                        max: 100,
                        minMessage: 'Your name must be at least {{ limit }} characters long',
                        maxMessage: 'Your name cannot be longer than {{ limit }} characters'
                    )
                ]
            ])
            ->add('result', CheckboxType::class, [
                'label' => "Done",
            ])
            ->add('date', DateTimeType::class, [
                'date_label' => 'Date',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'choice your category'
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Submit",

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
