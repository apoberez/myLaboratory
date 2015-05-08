<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 06.04.15
 * Time: 23:39
 */

namespace AP\MarketBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductPropertiesController
 * @package AP\MarketBundle\Controller\Admin
 */
class ProductPropertiesController extends Controller
{
    public function createAction()
    {
        return $this->render('::base.html.twig');
    }

}