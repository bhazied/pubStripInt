<?php

namespace ContinuousNet\PubliPrBundle\Form;

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
 * Template Type
 * 
 * Render Template Type 
 * 
 * PHP version 5.4.4
 * 
 * @category   Symfony 2 Type
 * @package    ContinuousNet\PubliPrBundle\Form
 * @author     Sahbi KHALFALLAH <sahbi.khalfallah@continuousnet.com>
 * @copyright  2016 CONTINUOUS NET
 * @license   AMINOGRAM REGULAR LICENSE
 * @version    Release: 1.0
 * @link       http://publipr.continuousnet.com/ContinuousNet\PubliPrBundle/Form
 * @see        TemplateType
 * @since      Class available since Release 1.0
 * @access     public
 */
class TemplateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->add('picture', TextType::class)
            ->add('type', ChoiceType::class, array('choices' => array('Basic' => 'Basic', 'Theme' => 'Theme', 'Custom' => 'Custom', ), 'expanded' => false, 'multiple' => false))
            ->add('body', TextareaType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\PubliPrBundle\Entity\Template'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PubliPrBundle_Template';
    }
}