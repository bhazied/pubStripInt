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
 * Match Goal Type
 * 
 * Render Match Goal Type 
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
 * @see        MatchGoalType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class MatchGoalType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('match', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Match', 'choice_label' => 'name'))
            ->add('team', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('player', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Player', 'choice_label' => 'name'))
            ->add('minute', IntegerType::class)
            ->add('scoredWith', ChoiceType::class, array('choices' => array('LeftFoot' => 'LeftFoot', 'RightFoot' => 'RightFoot', 'Head' => 'Head', ), 'expanded' => false, 'multiple' => false))
            ->add('zone', ChoiceType::class, array('choices' => array('TopLeft' => 'TopLeft', 'TopCenter' => 'TopCenter', 'TopRight' => 'TopRight', 'BottomLeft' => 'BottomLeft', 'BottomCenter' => 'BottomCenter', 'BottomRight' => 'BottomRight', ), 'expanded' => false, 'multiple' => false))
            ->add('stadiumZone', ChoiceType::class, array('choices' => array('OutsideBox' => 'OutsideBox', 'InsideBox' => 'InsideBox', ), 'expanded' => false, 'multiple' => false))
            ->add('penalty', CheckboxType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\MatchGoal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_MatchGoal';
    }
}