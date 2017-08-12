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
 * User Payment Plan Type
 * 
 * Render User Payment Plan Type 
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
 * @see        UserPaymentPlanType
 * @since      Class available since Release 1.0
 * @access     public
 */
class UserPaymentPlanType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'PubliPrBundle:User', 'choice_label' => 'username'))
            ->add('paymentPlan', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'PubliPrBundle:PaymentPlan', 'choice_label' => 'name'))
            ->add('stripeReference', TextType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Active' => 'Active', 'Disabled' => 'Disabled', ), 'expanded' => false, 'multiple' => false))
            ->add('closeDate', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\PubliPrBundle\Entity\UserPaymentPlan'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PubliPrBundle_UserPaymentPlan';
    }
}