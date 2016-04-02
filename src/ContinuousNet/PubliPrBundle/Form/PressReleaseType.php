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
 * Press Release Type
 * 
 * Render Press Release Type 
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
 * @see        PressReleaseType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class PressReleaseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newsroom', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'PubliPrBundle:Newsroom', 'choice_label' => 'name'))
            ->add('title', TextType::class)
            ->add('slug', TextType::class)
            ->add('description', TextareaType::class)
            ->add('picturePreview', TextType::class)
            ->add('content', TextareaType::class)
            ->add('isHeadline', CheckboxType::class)
            ->add('autoPublishing', CheckboxType::class)
            ->add('startPublishing', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('endPublishing', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('publishDateTime', DateTimeType::class, array('widget' => 'single_text', 'input' => 'datetime'))
            ->add('metaTitle', TextareaType::class)
            ->add('metaDescription', TextareaType::class)
            ->add('metaKeywords', TextareaType::class)
            ->add('status', ChoiceType::class, array('choices' => array('Draft' => 'Draft', 'Online' => 'Online', 'Deactivated' => 'Deactivated', 'Offline' => 'Offline', 'Deleted' => 'Deleted', 'Archived' => 'Archived', ), 'expanded' => false, 'multiple' => false))
            ->add('totalPrints', IntegerType::class)
            ->add('totalHits', IntegerType::class)
            ->add('totalComments', IntegerType::class)
            ->add('totalRatings', IntegerType::class)
            ->add('averageRatings', TextType::class)
            ->add('totalLikes', IntegerType::class)
            ->add('totalDislikes', IntegerType::class)
            ->add('totalBookmarks', IntegerType::class)
            ->add('totalShares', IntegerType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\PubliPrBundle\Entity\PressRelease'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PubliPrBundle_PressRelease';
    }
}