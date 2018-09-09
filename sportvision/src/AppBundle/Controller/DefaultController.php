<?php

namespace AppBundle\Controller;

use AppBundle\Configuration\QueryType;
use AppBundle\Entity\Article;
use AppBundle\Entity\Company;
use AppBundle\Input\ArticleFilterInput;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'info' => phpinfo(),
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Method("GET")
     * @Route("/firme")
     */
    public function listCompaniesAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository(Company::class);
        $companies= $repository->findAll();

        return new JsonResponse(array('companies' => $companies));

    }

    /**
     * @Method("GET")
     * @Route("/artikli")
     * @QueryType("article_filter", data="input")
     */
    public function listActiclesAction(Request $request, ArticleFilterInput $input)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $articles = $entityManager->getRepository(Article::class)->findAll();
//        $as = [36,37,38,39,40,41,42,43,44];name
//        $articles[0]->setSizes($as);
//        $articles[1]->setSizes($as);
//        $entityManager->flush($articles);

        $repository = $this->getDoctrine()
            ->getRepository(Article::class);
        $qb = $repository->createQueryBuilder('a');

        if (isset($input->gender)) {
            $qb->andWhere('a.gender = :gender');
        }
        if (isset($input->type)) {
            $qb->andWhere('a.type = :type');
        }
        if (isset($input->name)) {
            $qb->andWhere('a.name like :name');
        }
        if (isset($input->sport)) {
            $qb->andWhere('a.sport like :sport');
        }



        if (isset($input->gender)) {
            $qb->setParameter('gender', $input->gender);
        }
        if (isset($input->type)) {
            $qb->setParameter('type', $input->type);
        }
        if (isset($input->name)) {
            $qb->setParameter('name', '%'.$input->name.'%');
        }
        if (isset($input->sport)) {
            $qb->setParameter('sport', $input->sport);
        }




        if (isset($input->page)) {
            $qb->setFirstResult(($input->page-1)* $input->limit);
        }

        if (isset($input->limit)) {
            $qb->setMaxResults($input->limit);
        }

        $qb->orderBy('a.id', 'asc');
        $query = $qb->getQuery();

        $articles = $query->getResult();
        $query->free();
        return new JsonResponse(array('articles' => $articles));


    }

//    TODO(Ana): napravi projekat na githubu
}
