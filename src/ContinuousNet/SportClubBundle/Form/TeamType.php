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
 * Team Type
 * 
 * Render Team Type 
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
 * @see        TeamType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class TeamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Country', 'choice_label' => 'name'))
            ->add('name', TextType::class)
            ->add('nameAr', TextType::class)
            ->add('nameFr', TextType::class)
            ->add('alias', TextType::class)
            ->add('picture', TextType::class)
            ->add('presidentName', TextType::class)
            ->add('coachName', TextType::class)
            ->add('fondationYear', IntegerType::class)
            ->add('stadium', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Stadium', 'choice_label' => 'name'))
            ->add('address', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('phone', TextType::class)
            ->add('fax', TextType::class)
            ->add('email', EmailType::class)
            ->add('website', TextType::class)
            ->add('color', TextType::class)
            ->add('teamType', ChoiceType::class, array('choices' => array('Club' => 'Club', 'National' => 'National', ), 'expanded' => false, 'multiple' => false))
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
            ->add('summary', TextareaType::class)
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
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\Team'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_Team';
    }
}