<?php

namespace App\Form;

use App\Entity\CustomerMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactType extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator) {}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = $this->translator;
        $defaults = [
            'row_attr' => ['class' => 'form-floating'],
            'required' => true,
            'translation_domain' => 'contact',
        ];
        $builder
            ->add('name', TextType::class, [
                'label' => $trans->trans('Name', domain: 'contact'),
                'constraints' => [
                    new NotBlank()
                ],
                'attr' => ['autocomplete' => 'off', 'class' => 'contact-input form-control', 'placeholder' => '.'],
                ...$defaults
            ])
            ->add('email', EmailType::class, [
                'label' => $trans->trans('Email', domain: 'contact'),
                'constraints' => [
                    new NotBlank()
                ],
                'attr' => ['autocomplete' => 'off', 'class' => 'contact-input form-control', 'placeholder' => '.'],
                ...$defaults
            ]);

        if(!empty($options['withMessage']) && $options['withMessage'])
        {
            $builder->add('message', TextareaType::class, [
                'label' => $trans->trans('Message', domain: 'contact'),
                'attr' => ['style' => 'height: 150px', 'class' => 'contact-input form-control', 'placeholder' => '.'],
                'constraints' => [
                    new NotBlank()
                ],
                ...$defaults
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerMessage::class
        ]);

        $resolver->setDefined('withMessage');
    }
}
