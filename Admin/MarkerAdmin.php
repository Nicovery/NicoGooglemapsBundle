<?php
namespace Nico\GooglemapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class MarkerAdmin extends Admin
{


    /**
    * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
    *
    * @return void
    */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
        ->add('map.name')
        ->add('title')
        ->add('lat')
        ->add('lng')
        ;
    }

    /**
    * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
    *
    * @return void
    */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // var_dump($this);
        $formMapper
        ->with('General')
            ->add('map')
            ->add('title')
            ->add('lat','textarea')
            ->add('lng','textarea');

            //do not display those fields when it called in a sonata_type_collection
            if($this->isSonataTypeCollection()){
                $formMapper->add('icone', 'sonata_type_model_list', array())
                ->add('information', 'ckeditor', array());
            }
            $formMapper->add('visible')
        ->end()
        ;
    }

    protected function isSonataTypeCollection(){
        if(empty($this->parentFieldDescription)){
            return true;
        }else{
             if($this->parentFieldDescription->getType() != 'sonata_type_collection'){
                    return true;
                }
        }
        return false;
    }

    /**
    * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
    *
    * @return void
    */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('title')
        ->add('_action', 'actions', array(
            'actions' => array(
                'view' => array(),
                'edit' => array(),
                'delete' => array(),
                )
            ))
        ;
    }

    /**
    * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
    *
    * @return void
    */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('title')
        ->add('map.name')
        ;
    }
}