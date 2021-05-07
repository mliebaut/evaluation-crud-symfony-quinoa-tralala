<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Redacteurs;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\RedacteursRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/blog", name="blog")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/articles", name="articles", methods={"GET"})
     */

    public function getArticles(): JsonResponse
    {
    
        $allArticles = $this->getDoctrine()->getRepository(Articles::class)->findAll();
        // dump($allArticles);
        $articles = [];

        foreach ($allArticles as $article) {
            $articles[] = [
                'id' => $article->getId(),
                'titre'=> $article->getTitre(),
                'resumecourt'=> $article->getResumeCourt(),
                'description'=> $article->getDescription(),
                'idcategorie'=> $article->getIdCategorie()->getLibelle(),
                'idredacteur'=> $article->getIdRedacteur()->getNom()
            ];
        }
        return new JsonResponse($articles);
    }

    /**
    * @Route ("/articles/{id}"), name="get_articles_by_id", methods={"GET"}, requirements={"id"}={"\d+"})
    */

    public function getArticleById(int $id):JsonResponse {
        
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id'=> $id]);

        $articledetails = [];

        $articledetails[] = [
            'titre'=> $article->getTitre(),
            'resumecourt'=> $article->getResumeCourt(),
            'description'=> $article->getDescription(),
            'idcategorie'=> $article->getIdCategorie()->getLibelle(),
            'idredacteur'=> $article->getIdRedacteur()->getNom()
        ];
        dump($articledetails);
        return new JsonResponse($articledetails);
    }

    /**
     * @Route ("/addnewarticle"), name="add_new_article", methods={"POST"}
     */

    public function addNewArticle(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $json = json_decode($request->getContent());
        // dd($json);
        if ($json->apikey == 'keytest') {

            $categorie = $em->getRepository('App:Categories')->findOneById($json->categorie);
            $redacteur = $em->getRepository('App:Redacteurs')->findOneById($json->redacteur);

            $new = new Articles();
            $new->setTitre($json->titre);
            $new->setResumeCourt($json->resumecourt);
            $new->setDescription($json->description);
            $new->setIdCategorie($categorie);
            $new->setIdRedacteur($redacteur);

            $em->persist($new);
            $em->flush();

            return new Response('ok');
        }
        else {
            return new Response('erreur');
        }
    }

    /**
     * @Route ("/updatearticle/{id}"), name="update_article", methods={"PUT"}, requirements={"id"}={"\d+"}}
     */

    public function updateArticle(Request $request, $id, EntityManagerInterface $em):Response {

        $json = json_decode($request->getContent());

        // dd($json);
        if ($json->apikey == 'keytest') {

            $categorie = $em->getRepository('App:Categories')->findOneById($json->categorie);
            $redacteur = $em->getRepository('App:Redacteurs')->findOneById($json->redacteur);

            $new = $em->getRepository('App:Articles')->findOneById($id);
            $new->setTitre($json->titre);
            $new->setResumeCourt($json->resumeCourt);
            $new->setDescription($json->description);
            $new->setIdCategorie($categorie);
            $new->setIdRedacteur($redacteur);

            $em->persist($new);
            $em->flush();


            return new Response('ok');
        }

        else {
            return new Response('erreur');
        }
    }

    /**
    * @Route("/delete/{id}"), name="delete_article_by_id", methods={"DELETE"}, requirements={"id"}={"\d+"})
    */

    public function deleteArticleById(Request $request, $id, EntityManagerInterface $em): Response {
        
        $new = $em->getRepository('App:Articles')->findOneById($id);
        $em->remove($new);
        $em->flush();

        return new Response('success');
    }

    /**
    * @Route ("/categories"), name="get_categories", methods={"GET"}
    */
    public function getCategories(): JsonResponse
    {
    
        $allCategories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        // dump($allCategories);
        $categories = [];

        foreach ($allCategories as $categorie) {
            $categories[] = [
                'id'=> $categorie->getId(),
                'libelle'=> $categorie->getLibelle()
            ];
        }
        // print_r($categories);
        return new JsonResponse($categories);
    }

    /**
    * @Route ("/categories/{id}"), name="get_categories_by_id", methods={"GET"}, requirements={"id"}={"\d+"})
    */

    public function getCategorieById(int $id):JsonResponse {
        
        $categorie = $this->getDoctrine()->getRepository(Categories::class)->findOneBy(['id'=> $id]);

        $categoriedetails = [];

        $categoriedetails[] = [
            'id'=> $categorie->getId(),
            'libelle'=> $categorie->getLibelle()
        ];
        dump($categoriedetails);
        return new JsonResponse($categoriedetails);
    }

    /**
     * @Route ("/addnewcategorie"), name="add_new_categorie", methods={"POST"}
     */

    public function addNewCategorie(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $json = json_decode($request->getContent());

        $new = new Categories();
        $new->setLibelle($json->libelle);

        $em->persist($new);
        $em->flush();

        return new Response('ok');
    }

    /**
     * @Route ("/updatecategorie/{id}"), name="update_categorie", methods={"PUT"}, requirements={"id"}={"\d+"}}
     */

    public function updateCategorie(Request $request, $id, EntityManagerInterface $em):Response {

        $json = json_decode($request->getContent());

        $new = $em->getRepository('App:Categories')->findOneById($id);
        $new->setLibelle($json->libelle);

        $em->persist($new);
        $em->flush();

        return new Response('ok');
    }

    /**
    * @Route("/deletecategorie/{id}"), name="delete_categorie_by_id", methods={"DELETE"}, requirements={"id"}={"\d+"})
    */

    public function deleteCategorieById(Request $request, $id, EntityManagerInterface $em): Response {
        
        $new = $em->getRepository('App:Categories')->findOneById($id);
        $em->remove($new);
        $em->flush();

        return new Response('success');
    }

    /**
    * @Route ("/redacteurs"), name="get_redacteurs", methods={"GET"}
    */
    public function getRedacteurs(): JsonResponse
    {
    
        $allRedacteurs = $this->getDoctrine()->getRepository(Redacteurs::class)->findAll();

        // dd($allRedacteurs);
        $redacteurs = [];

        foreach ($allRedacteurs as $redacteur) {
            $redacteurs[] = [
                'id'=> $redacteur->getId(),
                'nom'=> $redacteur->getNom(),
                'prenom'=> $redacteur->getPrenom(),
                'email'=> $redacteur->getEmail()
            ];
        }
        // print_r($redacteurs);
        return new JsonResponse($redacteurs);
    }

    /**
    * @Route ("/redacteurs/{id}"), name="get_redacteurs_by_id", methods={"GET"}, requirements={"id"}={"\d+"})
    */

    public function getRedacteurById(int $id):JsonResponse {
        
        $redacteur = $this->getDoctrine()->getRepository(Redacteurs::class)->findOneBy(['id'=> $id]);

        $redacteurdetails = [];

        $redacteurdetails[] = [
            'id'=> $redacteur->getId(),
            'nom'=> $redacteur->getNom(),
            'prenom' => $redacteur->getPrenom(),
            'email' => $redacteur->getEmail()
        ];
        dump($redacteurdetails);
        return new JsonResponse($redacteurdetails);
    }

    /**
     * @Route ("/addnewredacteur"), name="add_new_redacteur", methods={"POST"}
     */

    public function addNewRedacteur(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $json = json_decode($request->getContent());

        $new = new Redacteurs();
        $new->setNom($json->nom);
        $new->setPrenom($json->prenom);
        $new->setEmail($json->email);

        $em->persist($new);
        $em->flush();

        return new Response('ok');
    }

    /**
     * @Route ("/updateredacteur/{id}"), name="update_redacteur", methods={"PUT"}, requirements={"id"}={"\d+"}}
     */

    public function updateRedacteur(Request $request, $id, EntityManagerInterface $em):Response {

        $json = json_decode($request->getContent());

        $new = $em->getRepository('App:Redacteurs')->findOneById($id);
        $new->setNom($json->nom);
        $new->setPrenom($json->prenom);
        $new->setEmail($json->email);

        $em->persist($new);
        $em->flush();

        return new Response('ok');
    }

    /**
    * @Route("/deleteredacteur/{id}"), name="delete_redacteur_by_id", methods={"DELETE"}, requirements={"id"}={"\d+"})
    */

    public function deleteRedacteurById(Request $request, $id, EntityManagerInterface $em): Response {
        
        $new = $em->getRepository('App:Redacteurs')->findOneById($id);
        $em->remove($new);
        $em->flush();

        return new Response('success');
    }
}

