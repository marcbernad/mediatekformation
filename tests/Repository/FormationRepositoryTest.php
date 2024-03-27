<?php

namespace App\Tests\Repository;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of FormationRepositoryTest
 *
 * @author marcb
 */
class FormationRepositoryTest extends KernelTestCase {

    public function recupRepository(): FormationRepository {
        self::bootKernel();
        $repository = self::getContainer()->get(FormationRepository::class);
        return $repository;
    }

    public function testNbFormations() {
        $repository = $this->recupRepository();
        $nbFormations = $repository->count([]);
        $this->assertEquals(2, $nbFormations);
    }

    public function newFormation(): Formation {
        $formation = (new Formation())
                ->setTitle("FormationTest")
                ->setVideoId("123456789")
                ->setPublishedAt(new \DateTime("now"));
        return $formation;
    }

    public function testAddFormation() {
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $nbFormations = $repository->count([]);
        $repository->add($formation, true);
        $this->assertEquals($nbFormations + 1, $repository->count([]), "erreur lors de l'ajout");
    }

    public function testRemoveFormation() {
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $repository->add($formation, true);
        $nbFormations = $repository->count([]);
        $repository->remove($formation, true);
        $this->assertEquals($nbFormations - 1, $repository->count([]), "erreur lors de la suppression");
    }

    public function testFindAllOrderBy() {
        $repository = $this->recupRepository();

        // Test avec le champ 'title' en ordre croissant
        $formations = $repository->findAllOrderBy('title', 'ASC');
        for ($i = 0; $i < count($formations) - 1; $i++) {
            $this->assertLessThanOrEqual(0, strcmp($formations[$i]->getTitle(), $formations[$i + 1]->getTitle()));
        }

        // Test avec le champ 'title' en ordre décroissant
        $formations = $repository->findAllOrderBy('title', 'DESC');
        for ($i = 0; $i < count($formations) - 1; $i++) {
            $this->assertGreaterThanOrEqual(0, strcmp($formations[$i]->getTitle(), $formations[$i + 1]->getTitle()));
        }
    }

    public function testFindByContainValue() {
        $repository = $this->recupRepository();

        // Test avec le champ 'title'
        $formations = $repository->findByContainValue('title', 'Déploiement');
        foreach ($formations as $formation) {
            $this->assertStringContainsString('Déploiement', $formation->getTitle());
        }

        // Test avec le champ 'title' contenant une valeur vide
        $allFormations = $repository->findAll();
        $formations = $repository->findByContainValue('title', '');
        $this->assertEquals(count($allFormations), count($formations));
    }

    public function testFindAllLasted() {
        $repository = $this->recupRepository();

        // Test avec les 5 formations les plus récentes
        $nb = 1;
        $formations = $repository->findAllLasted($nb);
        $this->assertCount($nb, $formations);

        // Vérifiez que les formations sont bien triées par date de publication en ordre décroissant
        for ($i = 0; $i < count($formations) - 1; $i++) {
            $this->assertGreaterThanOrEqual($formations[$i + 1]->getPublishedAt(), $formations[$i]->getPublishedAt());
        }
    }

    public function testFindAllForOnePlaylist() {
        $repository = $this->recupRepository();

        // Test avec une playlist spécifique
        $idPlaylist = 1; // Remplacez par l'ID d'une playlist existante dans votre base de données
        $formations = $repository->findAllForOnePlaylist($idPlaylist);
        foreach ($formations as $formation) {
            $this->assertEquals($idPlaylist, $formation->getPlaylist()->getId());
        }

        // Test avec une playlist qui n'existe pas
        $idPlaylist = 9999; // Supposons que cette playlist n'existe pas
        $formations = $repository->findAllForOnePlaylist($idPlaylist);
        $this->assertCount(0, $formations);
    }

}
