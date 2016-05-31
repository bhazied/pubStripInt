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
 * Image Category Type
 * 
 * Render Image Category Type 
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
 * @see        ImageCategoryType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class ImageCategoryType extends AbstractType
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
            ->add('slug', TextType::class)
            ->add('slugAr', TextType::class)
            ->add('slugFr', TextType::class)
            ->add('picture', TextType::class)
            ->add('description', TextType::class)
            ->add('descriptionAr', TextType::class)
            ->add('descriptionFr', TextType::class)
            ->add('parent', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:ImageCategory', 'choice_label' => 'name'))
            ->add('imageType', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:ImageType', 'choice_label' => 'name'))
            ->add('ordering', IntegerType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
            ->add('images', EntityType::class, array('expanded' => true, 'multiple' => true, 'class' => 'SportClubBundle:Image', 'choice_label' => 'name'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\ImageCategory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_ImageCategory';
    }
}