<?php
namespace Nico\GooglemapsBundle\Block\Service;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\EngineInterface;

use Doctrine\ORM\EntityManager;
// use Symfony\Component\Routing\Route;

class GooglemapsBlockService extends BaseBlockService{
	protected $container;
    protected $em;

	public function __construct($name, EngineInterface $templating,ContainerInterface $container,EntityManager $em)
    {
        parent::__construct($name, $templating);
        $this->em = $em;
        $this->container    = $container;
    }

    /**
    * Valid the settings data
    */
    function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
             ->with('settings.template')
                 ->assertNotNull(array())
                 ->assertNotBlank()
             ->end()
             ->with('settings.map')
                 ->assertNotNull(array())
                 ->assertNotBlank()
             ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
       $settings =  $blockContext->getSettings();
       $repoMap = $this->em->getRepository('NicoGooglemapsBundle:Map');
       // $map = $repoMap->findOneById($settings['map']);
       $map = $repoMap->myFindOneById($settings['map']);
       return $this->renderResponse($blockContext->getTemplate(), array(
        'block'     => $blockContext->getBlock(),
        'settings'  => $blockContext->getSettings(),
        'map'       => $map,
        ), $response);
   }


    /**
     * {@inheritdoc}
     * The form that will be displayed in the Admin
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        //get the maps for populate the select
        $repoMap = $this->em->getRepository('NicoGooglemapsBundle:Map');
        $maps = $repoMap->findAll();
        $options = array();
        foreach($maps as $map){
            $options += array($map->getId() => $map->getName());
        }
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('template', 'text', array()),
                array('map','choice',array('choices'=>$options))
                )
            ));
    }

    /**
     * {@inheritdoc}
     * The name of the Bloc for the Admin section
     */
    public function getName()
    {
        return 'Google Map (nico)';
    }

    /**
     * {@inheritdoc}
     * Set default value for the settings
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'NicoGooglemapsBundle:Block:map.html.twig',
            'map'=>''
            ));
    }

}