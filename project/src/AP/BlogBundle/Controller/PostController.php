<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 27.03.15
 * Time: 20:14
 */

namespace AP\BlogBundle\Controller;


use AP\BlogBundle\Document\Post;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @ApiDoc(
     * description="List of all posts"
     *)
     *
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postsAction(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getRepository('APBlogBundle:Post');
        $posts = $dm->findAll();

        if ('json' === $request->get('_format')) {
            return new JsonResponse($posts);
        }
        return $this->render('APBlogBundle:Default:index.html.twig');
    }
}