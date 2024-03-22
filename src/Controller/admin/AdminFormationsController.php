<?php

namespace App\Controller\admin;

use App\Entity\Formation;
use App\Repository\CategorieRepository;
use App\Repository\FormationRepository;
use App\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminFormationsController
 *
 * @author marcb
 */
class AdminFormationsController extends AbstractController 
{   
    
    /**
     * @var string
     */
    private $pageFormations = 'admin/admin.formations.html.twig';
 
    /**
     * @var string
     */
    private $pageFormation = 'admin/admin.formation.html.twig';
    
    /**
     * @var FormationRepository
     */
    private $formationRepository;
    
    /**
     * @var CategorieRepository
     */
    private $categorieRepository;

    /**
     * 
     * @param FormationRepository $repository
     */
    public function __construct(FormationRepository $repository, CategorieRepository $categorieRepository) {
        $this->formationRepository = $repository;
        $this->categorieRepository = $categorieRepository;
    }
    
    /**
     * @Route("/admin", name="admin.formations")
     * @return Response
     */
    public function index(): Response
    {
        $formations = $this->formationRepository->findAllOrderBy('publishedAt', 'DESC');
        $categories = $this->categorieRepository->findAll();
        return $this->render("admin/admin.formations.html.twig", [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("admin/formations/tri/{champ}/{ordre}/{table}", name="admin.formations.sort")
     * @param type $champ
     * @param type $ordre
     * @param type $table
     * @return Response
     */
    public function sort($champ, $ordre, $table=""): Response
    {
        $formations = $this->formationRepository->findAllOrderBy($champ, $ordre, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render($this->pageFormations, [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }
    
    /**
     * @Route("admin/formations/recherche/{champ}/{table}", name="admin.formations.findallcontain")
     * @param type $champ
     * @param Request $request
     * @param type $table
     * @return Response
     */
    public function findAllContain($champ, Request $request, $table=""): Response
    {
        $valeur = $request->get("recherche");
        $formations = $this->formationRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render($this->pageFormations, [
            'formations' => $formations,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table
        ]);
    }
    
    /**
     * @Route("admin/formations/formation/{id}", name="admin.formations.showone")
     * @param type $id
     * @return Response
     */
    public function showOne($id): Response
    {
        $formation = $this->formationRepository->find($id);
        return $this->render($this->pageFormation, [
            'formation' => $formation
        ]);
    }
    
    
    /**
     * @Route("/admin/edit/{id}", name="admin.formation.edit")
     * @param Formation $formation
     * @param Request $request
     * @return Response
     */
    public function edit(Formation $formation, Request $request): Response{
        $formFormation = $this->createForm(FormationType::class, $formation);

        $formFormation->handleRequest($request);
        if($formFormation->isSubmitted() && $formFormation->isValid()){
            $this->formationRepository->add($formation, true);
            return $this->redirectToRoute('admin.formations');
        }     

        return $this->render("admin/admin.formation.edit.html.twig", [
            'formation' => $formation,
            'formformation' => $formFormation->createView()
        ]);        
    }
    
    /**
     * @Route("/admin/ajout", name="admin.formation.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request): Response{
        $formation = new Formation();
        $formFormation = $this->createForm(FormationType::class, $formation);

        $formFormation->handleRequest($request);
        if($formFormation->isSubmitted() && $formFormation->isValid()){
            $this->formationRepository->add($formation, true);
            return $this->redirectToRoute('admin.formations');
        }     

        return $this->render("admin/admin.formation.ajout.html.twig", [
            'formation' => $formation,
            'formformation' => $formFormation->createView()
        ]);        
    }     
    
     /**
     * @Route("/admin/suppr/{id}", name="admin.formation.suppr")
     * @param int $id
     * @return Response
     */
    public function suppr(int $id): Response
    {
        $formation = $this->formationRepository->find($id);
        $this->formationRepository->remove($formation, true);
        return $this->redirectToRoute('admin.formations');
    }
}
