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
 * Sport Event Type
 * 
 * Render Sport Event Type 
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
 * @see        SportEventType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class SportEventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sport', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Sport', 'choice_label' => 'name'))
            ->add('season', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Season', 'choice_label' => 'name'))
            ->add('postType', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:PostType', 'choice_label' => 'name'))
            ->add('postCategory', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:PostCategory', 'choice_label' => 'name'))
            ->add('country', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Country', 'choice_label' => 'name'))
            ->add('name', TextType::class)
            ->add('nameAr', TextType::class)
            ->add('nameFr', TextType::class)
            ->add('slug', TextType::class)
            ->add('slugAr', TextType::class)
            ->add('slugFr', TextType::class)
            ->add('picture', TextType::class)
            ->add('alias', TextType::class)
            ->add('aliasAr', TextType::class)
            ->add('aliasFr', TextType::class)
            ->add('ordering', IntegerType::class)
            ->add('teamType', ChoiceType::class, array('choices' => array('Club' => 'Club', 'National' => 'National', ), 'expanded' => false, 'multiple' => false))
            ->add('enableCalendar', CheckboxType::class)
            ->add('enableLive', CheckboxType::class)
            ->add('enableTable', CheckboxType::class)
            ->add('enableResults', CheckboxType::class)
            ->add('enableTeams', CheckboxType::class)
            ->add('enableScorers', CheckboxType::class)
            ->add('enableStadia', CheckboxType::class)
            ->add('enablePrizeWinners', CheckboxType::class)
            ->add('enableStatistics', CheckboxType::class)
            ->add('enableLineUp', CheckboxType::class)
            ->add('enablePosts', CheckboxType::class)
            ->add('enableVideos', CheckboxType::class)
            ->add('enableImages', CheckboxType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
            ->add('eurosport', TextType::class)
            ->add('lequipe', TextType::class)
            ->add('teams', EntityType::class, array('expanded' => true, 'multiple' => true, 'class' => 'SportClubBundle:Team', 'choice_label' => 'name'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\SportEvent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_SportEvent';
    }
}