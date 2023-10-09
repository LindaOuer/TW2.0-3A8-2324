<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/getAll', name: 'author_listA')]
    public function listAuthors(AuthorRepository $repo): Response
    {
        // $repo = $doctrine->getRepository(Author::class);
        $list = $repo->findAll(); /* select * from author */
        return $this->render('author/listA.html.twig', [
            'list' => $list
        ]);
    }
    #[Route('/getAuthor/{id}', name: 'author_getOneId')]
    public function getAuthor(AuthorRepository $repo, $id): Response
    {
        $author = $repo->find($id);
        /* select * from author where id= 1 */
        return $this->render('author/detailsAuthor.html.twig', [
            'author' => $author
        ]);
    }

    #[Route('/addAuthorStatic', name: 'author_addStatic')]
    public function addAuthorStatic(ManagerRegistry $manager): Response
    {

        $author = new Author();
        $author->setUsername('Taha Hussein');
        $author->setEmail('taha.hussein@esprit.tn');

        $em = $manager->getManager();
        $em->persist($author);
        $em->flush();
        return new Response('Author Added');
    }
    #[Route('/addAuthor', name: 'author_add')]
    public function addAuthor(Request $req, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();

        $author = new Author();

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('author_listA');
        }

        return $this->renderForm('author/add.html.twig', ['f' => $form]);
    }

    #[Route('/editAuthor/{id}', name: 'author_edit')]
    public function editAuthor(Request $req, ManagerRegistry $manager, AuthorRepository $repo, $id): Response
    {
        $em = $manager->getManager();

        $author = $repo->find($id);

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('author_listA');
        }

        return $this->renderForm('author/add.html.twig', ['f' => $form]);
    }

    #[Route('/deleteAuthor/{id}', name: 'author_delete')]
    public function deleteAuthor(ManagerRegistry $manager, AuthorRepository $repo, $id): Response
    {
        $em = $manager->getManager();
        $author = $repo->find($id);

        $em->remove($author);
        $em->flush();

        return $this->redirectToRoute('author_listA');
    }
}
