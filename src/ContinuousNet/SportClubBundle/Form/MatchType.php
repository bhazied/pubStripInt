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
 * Match Type
 * 
 * Render Match Type 
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
 * @see        MatchType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class MatchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('nameAr', TextType::class)
            ->add('nameFr', TextType::class)
            ->add('gallery', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Gallery', 'choice_label' => 'name'))
            ->add('show', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Show', 'choice_label' => 'name'))
            ->add('day', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Day', 'choice_label' => 'name'))
            ->add('teamHome', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('teamAway', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('goalsHome', IntegerType::class)
            ->add('goalsAway', IntegerType::class)
            ->add('dateTime', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('postponed', CheckboxType::class)
            ->add('started', CheckboxType::class)
            ->add('ended', CheckboxType::class)
            ->add('country', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Country', 'choice_label' => 'name'))
            ->add('city', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:City', 'choice_label' => 'name'))
            ->add('stadium', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Stadium', 'choice_label' => 'name'))
            ->add('referee', TextType::class)
            ->add('refereeAr', TextType::class)
            ->add('refereeFr', TextType::class)
            ->add('totalShotsHome', IntegerType::class)
            ->add('totalShotsAway', IntegerType::class)
            ->add('shotsOnTargetHome', IntegerType::class)
            ->add('shotsOnTargetAway', IntegerType::class)
            ->add('blockedShotsHome', IntegerType::class)
            ->add('blockedShotsAway', IntegerType::class)
            ->add('shotsFromOutsideTheBoxHome', IntegerType::class)
            ->add('shotsFromOutsideTheBoxAway', IntegerType::class)
            ->add('shotsFromInsideTheBoxHome', IntegerType::class)
            ->add('shotsFromInsideTheBoxAway', IntegerType::class)
            ->add('shotAccuracyHome', IntegerType::class)
            ->add('shotAccuracyAway', IntegerType::class)
            ->add('duelsWonHome', IntegerType::class)
            ->add('duelsWonAway', IntegerType::class)
            ->add('aerialDuelsWonHome', IntegerType::class)
            ->add('aerialDuelsWonAway', IntegerType::class)
            ->add('interceptionsHome', IntegerType::class)
            ->add('interceptionsAway', IntegerType::class)
            ->add('totalPassesHome', IntegerType::class)
            ->add('totalPassesAway', IntegerType::class)
            ->add('passesLongHome', IntegerType::class)
            ->add('passesLongAway', IntegerType::class)
            ->add('passingAccuracyHome', IntegerType::class)
            ->add('passingAccuracyAway', IntegerType::class)
            ->add('passingAccuracyOppositionHalfHome', IntegerType::class)
            ->add('passingAccuracyOppositionHalfAway', IntegerType::class)
            ->add('totalCrossesHome', IntegerType::class)
            ->add('totalCrossesAway', IntegerType::class)
            ->add('successfulCrossesHome', IntegerType::class)
            ->add('successfulCrossesAway', IntegerType::class)
            ->add('tacklesHome', IntegerType::class)
            ->add('tacklesAway', IntegerType::class)
            ->add('tacklesWonHome', IntegerType::class)
            ->add('tacklesWonAway', IntegerType::class)
            ->add('clearancesHome', IntegerType::class)
            ->add('clearancesAway', IntegerType::class)
            ->add('foulsWonHome', IntegerType::class)
            ->add('foulsWonAway', IntegerType::class)
            ->add('foulsConcededHome', IntegerType::class)
            ->add('foulsConcededAway', IntegerType::class)
            ->add('possessionHome', IntegerType::class)
            ->add('possessionAway', IntegerType::class)
            ->add('substitutionsHome', IntegerType::class)
            ->add('substitutionsAway', IntegerType::class)
            ->add('penaltyGoalsHome', IntegerType::class)
            ->add('penaltyGoalsAway', IntegerType::class)
            ->add('offsidesHome', IntegerType::class)
            ->add('offsidesAway', IntegerType::class)
            ->add('cornersHome', IntegerType::class)
            ->add('cornersAway', IntegerType::class)
            ->add('penaltiesWonHome', IntegerType::class)
            ->add('penaltiesWonAway', IntegerType::class)
            ->add('injuredHome', IntegerType::class)
            ->add('injuredAway', IntegerType::class)
            ->add('cardsHome', IntegerType::class)
            ->add('cardsAway', IntegerType::class)
            ->add('yellowCardsHome', IntegerType::class)
            ->add('yellowCardsAway', IntegerType::class)
            ->add('doubleYellowCardsHome', IntegerType::class)
            ->add('doubleYellowCardsAway', IntegerType::class)
            ->add('redCardsHome', IntegerType::class)
            ->add('redCardsAway', IntegerType::class)
            ->add('recoveredBallsHome', IntegerType::class)
            ->add('recoveredBallsAway', IntegerType::class)
            ->add('turnoversHome', IntegerType::class)
            ->add('turnoversAway', IntegerType::class)
            ->add('previous', TextareaType::class)
            ->add('previousAr', TextareaType::class)
            ->add('previousFr', TextareaType::class)
            ->add('report', TextareaType::class)
            ->add('reportAr', TextareaType::class)
            ->add('reportFr', TextareaType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
            ->add('isHeadline', CheckboxType::class)
            ->add('live', CheckboxType::class)
            ->add('lastMinute', TextType::class)
            ->add('ticketingLink', TextType::class)
            ->add('liveStream', TextType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\Match'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_Match';
    }
}