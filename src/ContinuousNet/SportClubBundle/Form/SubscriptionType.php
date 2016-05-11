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
 * Subscription Type
 * 
 * Render Subscription Type 
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
 * @see        SubscriptionType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class SubscriptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visit', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Visit', 'choice_label' => 'ip'))
            ->add('package', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Package', 'choice_label' => 'name'))
            ->add('status', ChoiceType::class, array('choices' => array('Initialized' => 'Initialized', 'PaymentSuccess' => 'PaymentSuccess', 'PaymentFailed' => 'PaymentFailed', 'DeliveredSuccess' => 'DeliveredSuccess', 'DeliveredFailed' => 'DeliveredFailed', ), 'expanded' => false, 'multiple' => false))
            ->add('reference', TextType::class)
            ->add('token', TextType::class)
            ->add('msisdn', TextType::class)
            ->add('voucher', TextType::class)
            ->add('serialNumber', TextType::class)
            ->add('amount', TextType::class)
            ->add('currency', TextType::class)
            ->add('duration', TextType::class)
            ->add('startDate', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('endDate', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('price', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'SportClubBundle:Price', 'choice_label' => 'name'))
            ->add('priceValue', TextType::class)
            ->add('userAgent', TextareaType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\Subscription'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_Subscription';
    }
}