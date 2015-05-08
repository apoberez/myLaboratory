<?php
/**
 * Created by PhpStorm.
 * User: ap
 * Date: 01.04.15
 * Time: 0:20
 */

namespace AP\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentsController extends Controller
{
    public function commentsListAction()
    {
        $data = [
            ["author" => "Pete Hunt", "text"=>"This is one comment"],
            ["author" => "Jordan Walke", "text"=>"This is *another* comment"]
        ];
        return new JsonResponse($data);
    }

}