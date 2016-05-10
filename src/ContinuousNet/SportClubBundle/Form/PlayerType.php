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
 * Player Type
 * 
 * Render Player Type 
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
 * @see        PlayerType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ordering', IntegerType::class)
            ->add('position', ChoiceType::class, array('choices' => array('Forward' => 'Forward', 'Midfielder' => 'Midfielder', 'Defender' => 'Defender', 'GoalKeeper' => 'GoalKeeper', ), 'expanded' => false, 'multiple' => false))
            ->add('name', TextType::class)
            ->add('nameAr', TextType::class)
            ->add('nameFr', TextType::class)
            ->add('picture', TextType::class)
            ->add('firstName', TextType::class)
            ->add('firstNameAr', TextType::class)
            ->add('firstNameFr', TextType::class)
            ->add('lastName', TextType::class)
            ->add('lastNameAr', TextType::class)
            ->add('lastNameFr', TextType::class)
            ->add('birthDate', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('birthPlace', TextType::class)
            ->add('birthPlaceAr', TextType::class)
            ->add('birthPlaceFr', TextType::class)
            ->add('birthCountry', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Country', 'choice_label' => 'name'))
            ->add('nationalityCountry', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Country', 'choice_label' => 'name'))
            ->add('height', IntegerType::class)
            ->add('weight', TextType::class)
            ->add('shoeSize', TextType::class)
            ->add('writingHand', ChoiceType::class, array('choices' => array('Right' => 'Right', 'Left' => 'Left', ), 'expanded' => false, 'multiple' => false))
            ->add('strongerFoot', ChoiceType::class, array('choices' => array('Right' => 'Right', 'Left' => 'Left', ), 'expanded' => false, 'multiple' => false))
            ->add('maritalStatus', ChoiceType::class, array('choices' => array('Single' => 'Single', 'Married' => 'Married', ), 'expanded' => false, 'multiple' => false))
            ->add('wivesNames', TextType::class)
            ->add('sonsNames', TextType::class)
            ->add('daughtersNames', TextType::class)
            ->add('fatherName', TextType::class)
            ->add('motherName', TextType::class)
            ->add('brothersNames', TextType::class)
            ->add('sistersNames', TextType::class)
            ->add('education', TextType::class)
            ->add('personalAttributes', TextType::class)
            ->add('hobbies', TextType::class)
            ->add('favouriteFood', TextType::class)
            ->add('favouriteDrink', TextType::class)
            ->add('firstReplicaKit', TextType::class)
            ->add('tvShowRarelyMiss', TextType::class)
            ->add('teamClub', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('teamClubNumber', IntegerType::class)
            ->add('teamNational', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
            ->add('teamNationalNumber', IntegerType::class)
            ->add('personalBiography', TextareaType::class)
            ->add('technicalProfile', TextareaType::class)
            ->add('facebook', TextType::class)
            ->add('twitter', TextType::class)
            ->add('website', TextType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
            ->add('eurosport', TextType::class)
            ->add('lequipe', TextType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\Player'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_Player';
    }
}