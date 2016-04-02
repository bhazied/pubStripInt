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
 * Contact Type
 * 
 * Render Contact Type 
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
 * @see        ContactType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactGroup', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'PubliPrBundle:ContactGroup', 'choice_label' => 'name'))
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
            ->add('active', CheckboxType::class)
            ->add('unsubscribed', CheckboxType::class)
            ->add('unsubscribedAt', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\PubliPrBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PubliPrBundle_Contact';
    }
}