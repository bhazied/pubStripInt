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
 * Push Notification Type
 * 
 * Render Push Notification Type 
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
 * @see        PushNotificationType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class PushNotificationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('titleAr', TextType::class)
            ->add('titleFr', TextType::class)
            ->add('message', TextType::class)
            ->add('messageAr', TextType::class)
            ->add('messageFr', TextType::class)
            ->add('type', ChoiceType::class, array('choices' => array('MatchConfirmed' => 'MatchConfirmed', '30MinutesBefore' => '30MinutesBefore', 'LineUpsConfirmed' => 'LineUpsConfirmed', 'StartHalfTimeFullTime' => 'StartHalfTimeFullTime', 'Goals' => 'Goals', 'Substitutions' => 'Substitutions', 'Promotions' => 'Promotions', 'NewPost' => 'NewPost', 'NewVideo' => 'NewVideo', 'NewAudio' => 'NewAudio', 'NewPhotosGallery' => 'NewPhotosGallery', ), 'expanded' => false, 'multiple' => false))
            ->add('category', TextType::class)
            ->add('badge', IntegerType::class)
            ->add('sound', TextType::class)
            ->add('match', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Match', 'choice_label' => 'name'))
            ->add('matchSubstitution', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:MatchSubstitution', 'choice_label' => 'id'))
            ->add('matchGoal', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:MatchGoal', 'choice_label' => 'id'))
            ->add('post', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Post', 'choice_label' => 'title'))
            ->add('video', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Video', 'choice_label' => 'name'))
            ->add('audio', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Audio', 'choice_label' => 'name'))
            ->add('gallery', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Gallery', 'choice_label' => 'name'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\PushNotification'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_PushNotification';
    }
}