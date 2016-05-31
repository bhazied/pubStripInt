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
 * Match Commentary Type
 * 
 * Render Match Commentary Type 
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
 * @see        MatchCommentaryType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class MatchCommentaryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextType::class)
            ->add('commentAr', TextType::class)
            ->add('commentFr', TextType::class)
            ->add('match', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Match', 'choice_label' => 'name'))
            ->add('minute', IntegerType::class)
            ->add('icon', ChoiceType::class, array('choices' => array('Goal' => 'Goal', 'Caution' => 'Caution', 'Expulsion' => 'Expulsion', 'SecondCaution' => 'SecondCaution', 'OwnGoal' => 'OwnGoal', 'DisallowedGoal' => 'DisallowedGoal', 'Penalty' => 'Penalty', 'MissedPenalty' => 'MissedPenalty', 'Offside' => 'Offside', 'ThrowIn' => 'ThrowIn', 'Foul' => 'Foul', 'FreeKick' => 'FreeKick', 'CornerKick' => 'CornerKick', 'Injury' => 'Injury', 'Winner' => 'Winner', 'Assist' => 'Assist', 'Blocknote' => 'Blocknote', 'Whistle' => 'Whistle', 'Substitution' => 'Substitution', 'Miss' => 'Miss', 'Save' => 'Save', 'HandTouch' => 'HandTouch', 'PlayerIn' => 'PlayerIn', 'PlayerOut' => 'PlayerOut', 'StartFirstHalf' => 'StartFirstHalf', 'EndFirstHalf' => 'EndFirstHalf', 'StartSecondHalf' => 'StartSecondHalf', 'EndSecondHalf' => 'EndSecondHalf', 'ExtraTime' => 'ExtraTime', ), 'expanded' => false, 'multiple' => false))
            ->add('isPublished', CheckboxType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\MatchCommentary'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_MatchCommentary';
    }
}