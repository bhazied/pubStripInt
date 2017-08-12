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
 * Newsroom Type
 * 
 * Render Newsroom Type 
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
 * @see        NewsroomType
 * @since      Class available since Release 1.0
 * @access     public
 */
class NewsroomType extends AbstractType
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
            ->add('description', TextareaType::class)
            ->add('url', TextType::class)
            ->add('email', EmailType::class)
            ->add('logoPicture', TextType::class)
            ->add('bannerPicture', TextType::class)
            ->add('pressReleasesPerPage', IntegerType::class)
            ->add('backgroundColor', TextType::class)
            ->add('titleColor', TextType::class)
            ->add('titleFont', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'PubliPrBundle:Font', 'choice_label' => 'name'))
            ->add('textColor', TextType::class)
            ->add('textFont', EntityType::class, array('expanded' => false, 'multiple' => false, 'class' => 'PubliPrBundle:Font', 'choice_label' => 'name'))
            ->add('facebookLink', TextType::class)
            ->add('twitterLink', TextType::class)
            ->add('googlePlusLink', TextType::class)
            ->add('pinterestLink', TextType::class)
            ->add('instagramLink', TextType::class)
            ->add('youtubeLink', TextType::class)
            ->add('linkedinLink', TextType::class)
            ->add('vimeoLink', TextType::class)
            ->add('flickrLink', TextType::class)
            ->add('tumblrLink', TextType::class)
            ->add('css', TextareaType::class)
            ->add('enableSearch', CheckboxType::class)
            ->add('enableSocialNetworks', CheckboxType::class)
            ->add('enableMedia', CheckboxType::class)
            ->add('enableDate', CheckboxType::class)
            ->add('published', CheckboxType::class)
            ->add('piwikReference', IntegerType::class)
            ->add('users', EntityType::class, array('expanded' => true, 'multiple' => true, 'class' => 'PubliPrBundle:User', 'choice_label' => 'username'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\PubliPrBundle\Entity\Newsroom'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PubliPrBundle_Newsroom';
    }
}