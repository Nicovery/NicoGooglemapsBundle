<?php
namespace Nico\GooglemapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;



class MapAdmin extends Admin
{


    /**
 	* @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
 	*
 	* @return void
 	*/
 	protected function configureShowField(ShowMapper $showMapper)
 	{
 		$showMapper
 		->add('name')
 		->add('centerLng')
 		->add('centerLat')
 		->add('type')
 		;
 	}

    /**
 	* @param \Sonata\AdminBundle\Form\FormMapper $formMapper
 	*
 	* @return void
 	*/
    protected function configureFormFields(FormMapper $formMapper)
    {
    	$formMapper
    	->with('General')
	    	->add('name')
	 		->add('centerLat','textarea')
            ->add('centerLng','textarea')
	 		->add('zoom')
	 		->add('type','choice',array(
	 			'choices' =>array(
	 				'ROADMAP'=>'ROADMAP',
                    'HYBRID'=>'HYBRID',
	 				'SATELLITE'=>'SATELLITE',
	 				'TERRAIN'=>'TERRAIN',
	 				)
	 			))
	 		->add('visible')
    	->with('Marker')
	 		->add('markers', 'sonata_type_collection', array(
                //Prevents the "Delete" option from being displayed
                'type_options' => array('delete' => false,'label'=>'Map admin')
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ))

    	->end()
    	;
    }

    /**
 	* @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
 	*
 	* @return void
 	*/
    protected function configureListFields(ListMapper $listMapper)
    {
    	$listMapper
    	->addIdentifier('name')
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
    	->add('name')
    	;
    }
   
}



