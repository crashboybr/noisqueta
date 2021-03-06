<?php

namespace iList\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class AcessoriesFilterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
   

        /*$builder
            ->add('adType', 'choice', array(
                'choices' => array('1' => 'Novo', '2' => 'Usado'),
                'expanded' => true,
                'multiple' => true
            ))
            ->add('size' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Size' ,
                      'query_builder' => function(EntityRepository $er) {

                          return $er->createQueryBuilder('u')
                                ->innerJoin('u.categories', 's', 'WITH', 's.id = :category_id')
                                ->orderBy('u.size', 'ASC')
                                ->setParameter('category_id', 6);
                          
                          },
                      'property' => 'size' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('screen' , 'entity' , array(
                      'class'    => 'iListBackendBundle:ScreenSize' ,
                      'query_builder' => function(EntityRepository $er) {

                          return $er->createQueryBuilder('u')
                                ->innerJoin('u.categories', 's', 'WITH', 's.id = :category_id')
                                ->orderBy('u.size', 'ASC')
                                ->setParameter('category_id', 6);
                          
                          },
                      'property' => 'size' ,
                      'expanded' => true ,
                      'multiple' => true , ))
             ->add('processor' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Processor' ,
                      'query_builder' => function(EntityRepository $er) {

                          return $er->createQueryBuilder('u')
                                ->innerJoin('u.categories', 's', 'WITH', 's.id = :category_id')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('category_id', 6);
                          
                          },
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))
             ->add('memory' , 'entity' , array(
                      'class'    => 'iListBackendBundle:MemoryRam' ,
                      'query_builder' => function(EntityRepository $er) {

                          return $er->createQueryBuilder('u')
                                ->innerJoin('u.categories', 's', 'WITH', 's.id = :category_id')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('category_id', 6);
                          
                          },
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))*/
            $builder->add('subcategory' , 'entity' , array(
                      'class'    => 'iListBackendBundle:SubCategory' ,
                      'query_builder' => function(EntityRepository $er) {

                          return $er->createQueryBuilder('u')
                                ->innerJoin('u.category', 's', 'WITH', 's.id = :category_id')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter('category_id', 6);
                          
                          },
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('price_min', 'text', array('attr' => array('placeholder' => 'Min')))
            ->add('price_max', 'text', array('attr' => array('placeholder' => 'Max')))
            ->add('price_submit', 'submit', array('label' => 'ok'))
            
        ;




    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_frontendbundle_imac_filter';
    }
}
