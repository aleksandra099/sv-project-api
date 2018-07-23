<?php

namespace AppBundle\TypeForm;


use AppBundle\Input\ArticleFilterInput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleFilterFormType extends AbstractType
{
    /**
     * Returns the name of the form type
     *
     * @return string
     */
    public function getName()
    {
        return 'article_filter';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('page', 'integer');
        $builder->add('limit', 'integer', [
            'constraints' => [
                new Range([
                    'min' => 10,
                    'max' => 100,
                ])
            ]
        ]);
        $builder->add('type', 'text');
        $builder->add('gender', ChoiceType::class, [
            'choices' => [
                'm' => 'm',
                'f' => 'f',
                'u' => 'u',
                'cm' => 'cm',
                'cf' => 'cf',
            ]
        ]);
        $builder->add('sport', 'text');
        $builder->add('name', 'text');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleFilterInput::class,    //na koju klasu da se mapiraju polja iz forme
            'empty_data' => function() {
                return new ArticleFilterInput();
            },
        ]);
    }


}