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
 * Menu Type
 * 
 * Render Menu Type 
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
 * @see        MenuType
 * @since      Class available since Release 1.0
 * @deprecated Nothing
 * @access     public
 */
class MenuType extends AbstractType
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
            ->add('mode', ChoiceType::class, array('choices' => array('Link' => 'Link', 'ImageCategory' => 'ImageCategory', 'PostCategory' => 'PostCategory', 'VideoCategory' => 'VideoCategory', 'Album' => 'Album', 'Show' => 'Show', 'Sport' => 'Sport', 'SportEvent' => 'SportEvent', 'Team' => 'Team', 'Stadium' => 'Stadium', 'Player' => 'Player', 'Day' => 'Day', 'Package' => 'Package', ), 'expanded' => false, 'multiple' => false))
            ->add('menuCss', TextType::class)
            ->add('itemCss', TextType::class)
            ->add('activeCss', TextType::class)
            ->add('notActiveCss', TextType::class)
            ->add('firstCss', TextType::class)
            ->add('lastCss', TextType::class)
            ->add('beforeTxt', TextType::class)
            ->add('afterTxt', TextType::class)
            ->add('separator', TextType::class)
            ->add('columnsNumber', IntegerType::class)
            ->add('displayMode', ChoiceType::class, array('choices' => array('ImageWithText' => 'ImageWithText', 'ImageOnly' => 'ImageOnly', 'TextOnly' => 'TextOnly', ), 'expanded' => false, 'multiple' => false))
            ->add('textPosition', ChoiceType::class, array('choices' => array('None' => 'None', 'Top' => 'Top', 'Bottom' => 'Bottom', 'Left' => 'Left', 'Right' => 'Right', ), 'expanded' => false, 'multiple' => false))
            ->add('isPublished', CheckboxType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContinuousNet\SportClubBundle\Entity\Menu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SportClubBundle_Menu';
    }
}