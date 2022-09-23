<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/')]
    #[Route('/', name: 'home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class); //récupération du repo. avec l'objet "ManagerRegistry" injecté ($doctrine)
        $posts = $repository->findAll();    //récupère tous les posts (=SELECT * FROM 'post')
        dump($posts);
        return $this->render('post/index.html.twig', [
            "posts" => $posts
        ]);
    }
    
    #[Route('/post/new')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render('post/form.html.twig', [
            "post_form" => $form->createView()
        ]);
    }
    
    #[Route('/post/copy/{id<\d+>}', name: 'copy-post')]
    public function copy(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $copyPost = clone ($post);
        $form = $this->createForm(PostType::class, $copyPost);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($copyPost);
            $em->flush();
            return $this-> redirectToRoute("home");
        }
        return $this->render('post/form.html.twig', [
            "post_form" => $form->createView()
        ]);
    }
    
    #[Route('/post/edit/{id<\d+>}', name: 'edit-post')] //l'id doit être un chiffre
    public function update(Post $post, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->flush();
            return $this-> redirectToRoute("home");
        }
        return $this->render('post/form.html.twig', [
            "post_form" => $form->createView()
        ]);
    }

    #[Route('/post/delete/{id<\d+>}', name: 'delete-post')] //l'id doit être un chiffre
    public function delete(Post $post, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($post);
        $em->flush();
        return $this-> redirectToRoute("home");
    }    

}
