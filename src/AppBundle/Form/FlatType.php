<?php

/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-20
 * Time: 12:04
 */
namespace AppBundle\Form;

use AppBundle\Entity\Flat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlatType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("title", TextType::class, ["label" => "Nazwa", "attr" => ["class" => "form-control"] ])
            ->add("description", TextareaType::class, ["label" => "Opis", "attr" => ["class" => "form-control"] ])
            ->add("price", NumberType::class, ["label" => "Cena", "attr" => ["class" => "form-control"] ])
            ->add("area", NumberType::class, ["label" => "Metraż", "attr" => ["class" => "form-control"] ])
            ->add("bedrooms", NumberType::class, ["label" => "Sypialnie", "attr" => ["class" => "form-control"] ])
            ->add("bathrooms", NumberType::class, ["label" => "Łazienki", "attr" => ["class" => "form-control"] ])
            ->add("garages", IntegerType::class, ["label" => "Garaże", "attr" => ["class" => "form-control"]])
            ->add("expiresAt", DateTimeType::class, ["label" => "Data zakończenia", "data" => new \DateTime("+1 day +10 minutes")])
            ->add("submit", SubmitType::class, ["label" => "Zapisz", "attr" => ["class" => "btn btn-default"] ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(["data_class" => Flat::class]);
        //parent::configureOptions($resolver);
    }
}