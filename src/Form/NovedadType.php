<?php

namespace App\Form;

use App\Entity\Novedad;
use App\Entity\Concejal;
use App\Entity\Comision;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class NovedadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni', IntegerType::class, ['label' => 'DNI'])
            ->add('nombre', TextType::class, ['label' => 'Nombre'])
            ->add('patente', TextType::class, ['label' => 'Patente'])
            ->add('motivo', TextType::class, ['label' => 'Motivo'])
            ->add('concejal', EntityType::class, [          
                'class' => Concejal::class, 
                'placeholder' => 'Seleccionar',
                'required' => false])
            ->add('comision', EntityType::class, [          
                'class' => Comision::class, 
                'placeholder' => 'Seleccionar',
                'required' => false])                
            ->add('submit', SubmitType::class, ['label' => 'Registrar'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Novedad::class,
        ]);
    }
}
