<?php

namespace ContinuousNet\SportClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Prize Winner Type
 * 
 * Render Prize Winner Type 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 Type
 * @package    ContinuousNet\SportClubBundle\Form
 * @author     Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license   AMINOGRAM REGULAR LICENSE
 * @version    Release: 1.0
 * @link       http://sportclub.continuousnet.com/ContinuousNet\SportClubBundle/Form
 * @see        PrizeWinnerType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class PrizeWinnerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sportEvent', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:SportEvent', 'choice_label' => 'name'))
            ->add('year', TextType::class)
            ->add('teamHome', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('teamAway', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('scoreHome', IntegerType::class)
            ->add('scoreAway', IntegerType::class)
            ->add('country', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Country', 'choice_label' => 'name'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\PrizeWinner'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_PrizeWinner';
    }
}