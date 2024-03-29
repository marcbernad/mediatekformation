<?php

namespace App\Controller\admin;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminCategoriesController
 *
 * @author marcb
 */
class AdminCategoriesController extends AbstractController {
    
     /**
     * 
     * @var CategorieRepository
     */
    private $categorieRepository;

    /**
     * 
     * @param CategorieRepository $repository
     */
    public function __construct(CategorieRepository $repository) {
        $this->categorieRepository = $repository;
    }
    
    /**
     * @Route("/admin/categories", name="admin.categories")
     * @return Response
     */
    public function index(): Response{
        $categories = $this->categorieRepository->findAll();
        return $this->render("admin/admin.categories.html.twig", [
            'categories' => $categories
        ]);
    }
    
    /**
     * @Route("/admin/categorie/suppr/{id}", name="admin.categorie.suppr")
     * @param int $id
     * @return Response
     */
    public function suppr(int $id): Response {
        $categorie = $this->categorieRepository->find($id);

        // Vérifiez si la playlist contient des formations
        if (count($categorie->getFormations()) > 0) {
            // Si la playlist contient au moins une formation, affichez un message d'erreur
            $this->addFlash('error', 'La suppression n\'est pas possible car la catégorie est associée à une ou plusieurs formations.');
        } else {
            // Si la playlist est vide, elle peut être supprimée
            $this->categorieRepository->remove($categorie, true);
            $this->addFlash('success', 'La catégorie a été supprimée avec succès.');
        }

        return $this->redirectToRoute('admin.categories');
    }
   
   /**
    * @Route("/admin/categorie/ajout", name="admin.categorie.ajout")
    * @param Request $request
    * @return Response
    */
   public function ajout(Request $request): Response{
       $nomCategorie = $request->get("name");

       // Vérifiez si le nom de la catégorie est vide
       if(empty($nomCategorie)) {
           // Ajoutez un message flash d'erreur
           $this->addFlash('error', 'Le nom de la catégorie est requis.');

           // Redirigez vers la même page pour afficher le message flash
           return $this->redirectToRoute('admin.categories');
       }

       // Vérifiez si une catégorie avec le même nom existe déjà
       $categorieExistante = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['name' => $nomCategorie]);
       if($categorieExistante) {
           // Ajoutez un message flash d'erreur
           $this->addFlash('error', 'Une catégorie avec ce nom existe déjà.');

           // Redirigez vers la même page pour afficher le message flash
           return $this->redirectToRoute('admin.categories');
       }

       $categorie = new Categorie();
       $categorie->setName($nomCategorie);
       $this->categorieRepository->add($categorie, true);

       // Ajoutez un message flash de succès
       $this->addFlash('success', 'La catégorie a été ajoutée avec succès.');

       return $this->redirectToRoute('admin.categories');       
   }


}
