<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;

class EtablissementController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->redirect($this->generateUrl('etablissement_page', array('nb' => 1)));
    }

    /**
     * @Route("/etablissement/page/{nb}", name="etablissement_page")
     */
    public function showByPage(int $nb, Request $request, SessionInterface $session): Response
    {
        $max = $this->getDoctrine()->getRepository(Etablissement::class)->findMax();
        $session->set('page', $nb);
        $session->set('route', "etablissement_page");

        $idMax = $nb*50;
        $idMin = ($nb*50)-49;
        $nbMax = intdiv($max[0]['COUNT(id)'], 50);

        if($idMax > $max)
            $idMax = $max;

        $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findBetweenTwoId($idMin, $idMax);

        $search = $request->query->get('search');

        if(isset($search))
        {
            $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findResearch($search);
        }

        return $this->render('etablissement/show.html.twig', array('etablissements' => $etablissements,
        'nb' => $nb, 'nbMax' => $nbMax));

    }

    /**
     * @Route("/etablissement/departement/{id}/page/{nb}", name="etablissement_departement")
     */
    public function showByDepartement(String $id, int $nb, SessionInterface $session): Response
    {
        $max = $this->getDoctrine()->getRepository(Etablissement::class)->findMaxDepartement($id);
        $session->set('page', $nb);
        $session->set('route', "etablissement_departement");
        $session->set('id', $id);

        $idMax = $nb*50;
        $idMin = ($nb*50)-49;
        $nbMax = intdiv($max[0]['COUNT(id)'], 50);

        if($idMax > $max)
            $idMax = $max;

        $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findByDepartement($id, $idMin, $idMax);

        return $this->render('etablissement/show.html.twig', array('etablissements' => $etablissements,
            'nb' => $nb, 'nbMax' => $nbMax));
    }


    /**
     * @Route("/etablissement/commune/{id}/page/{nb}", name="etablissement_commune")
     */
    public function showByCommune(String $id, int $nb, SessionInterface $session): Response
    {
        $max = $this->getDoctrine()->getRepository(Etablissement::class)->findMaxCommune($id);
        $session->set('page', $nb);
        $session->set('route', "etablissement_commune");
        $session->set('id', $id);

        $idMax = $nb*50;
        $idMin = ($nb*50)-49;
        $nbMax = intdiv($max[0]['COUNT(id)'], 50);

        if($idMax > $max)
            $idMax = $max;

        $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findByCommune($id, $idMin, $idMax);
        
        return $this->render('etablissement/show.html.twig', array('etablissements' => $etablissements,
        'nb' => $nb, 'nbMax' => $nbMax));
    }


    /**
     * @Route("/etablissement/region/{id}/page/{nb}", name="etablissement_region")
     */
    public function showByRegion(String $id, int $nb, SessionInterface $session): Response
    {
        $max = $this->getDoctrine()->getRepository(Etablissement::class)->findMaxRegion($id);
        $session->set('page', $nb);
        $session->set('route', "etablissement_region");
        $session->set('id', $id);

        $idMax = $nb*50;
        $idMin = ($nb*50)-49;
        $nbMax = intdiv($max[0]['COUNT(id)'], 50);

        if($idMax > $max)
            $idMax = $max;

            $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findByRegion($id, $idMin, $idMax);

        return $this->render('etablissement/show.html.twig', array('etablissements' => $etablissements,
            'nb' => $nb, 'nbMax' => $nbMax));
    }


    /**
     * @Route("/etablissement/academie/{id}/page/{nb}", name="etablissement_academie")
     */
    public function showByAcademie(String $id, int $nb, SessionInterface $session): Response
    {
        $max = $this->getDoctrine()->getRepository(Etablissement::class)->findMaxAcademie($id);
        $session->set('page', $nb);
        $session->set('route', "etablissement_academie");
        $session->set('id', $id);

        $idMax = $nb*50;
        $idMin = ($nb*50)-49;
        $nbMax = intdiv($max[0]['COUNT(id)'], 50);

        if($idMax > $max)
            $idMax = $max;

            $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findByAcademie($id, $idMin, $idMax);

        return $this->render('etablissement/show.html.twig', array('etablissements' => $etablissements,
            'nb' => $nb, 'nbMax' => $nbMax));
    }


    /**
     * @Route("/etablissement/add", name="etablissement_add")
     */
    public function add(Request $request, SessionInterface $session)
    {
        $etablissement = new Etablissement();

        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();

            $page = $session->get('page');
            return $this->redirect($this->generateUrl('etablissement_page', array('nb' => $page)));
        }

        return $this->render('etablissement/form.html.twig', array(
            'form' => $form->createView(), 'requete' => "Créer"
        ));
    }

    /**
     * @Route("/etablissement/{id}/update", name="etablissement_update")
     */
    public function update(int $id, Request $request, SessionInterface $session)
    {
        $etablissement = $this->getDoctrine()->getRepository(Etablissement::class)->find($id);

        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();

            $page = $session->get('page');
            return $this->redirect($this->generateUrl('etablissement_page', array('nb' => $page)));
        }

        return $this->render('etablissement/form.html.twig', array(
            'form' => $form->createView(), 'requete' => "Modifier"
        ));
    }

    /**
     * @Route("/etablissement/{id}/delete", name="etablissement_delete")
     */
    public function delete(int $id, SessionInterface $session)
    {
        $page = $session->get('page');

        $em = $this->getDoctrine()->getManager();
        $etablissement = $this->getDoctrine()->getRepository(Etablissement::class)->find($id);

        $em->remove($etablissement);
        $em->flush();

        return $this->redirect($this->generateUrl('etablissement_page', array('nb' => $page)));
    }

    /**
     * @Route("/etablissement/commentaires/{id}", name="etablissement_commentaires")
     */
    public function ShowCommentaires(int $id)
    {
        $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->find($id);

        $commentaires = $etablissements->getCommentaires();

        return $this->render('commentaires/show.html.twig', array('commentaires' => $commentaires, 'id' => $id));
    }

    /**
     * @Route("/etablissement/commentaires/{id}/ajouter", name="commentaire_add")
     */
    public function addCommentaires(int $id, Request $request)
    {
        $etablissement = $this->getDoctrine()->getRepository(Etablissement::class)->find($id);
        $commentaire = new Commentaire();

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $commentaire->setDateCreation(new \DateTime());
            $commentaire->setEtablissement($etablissement);
            $em->persist($commentaire);
            $em->flush();

            return $this->redirect($this->generateUrl('etablissement_commentaires', array('id' => $id)));
        }

        return $this->render('commentaires/form.html.twig', array(
            'form' => $form->createView(), 'requete' => "Ajouter", 'id' => $id
        ));

        return new Response("Ajout d'un commentaires");
    }

    /**
     * @Route("/etablissement/commentaires/{id}/update/{idCommentaire}", name="commentaire_update")
     */
    public function updateCommentaire(int $id, int $idCommentaire, Request $request)
    {
        //trouver selon l'id de l'établissement
        $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->findOneBy(
            array('etablissement' => $id, 'id' => $idCommentaire)
        );

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            return $this->redirect($this->generateUrl('etablissement_commentaires', array('id' => $id)));
        }

        return $this->render('commentaires/form.html.twig', array(
            'form' => $form->createView(), 'requete' => "Modifier", 'id' => $id
        ));
    }

    /**
     * @Route("/etablissement/commentaire/{id}/delete/{idCommentaire}", name="commentaire_delete")
     */
    public function deleteCommentaire(int $id, int $idCommentaire)
    {
        $em = $this->getDoctrine()->getManager();
        //trouver selon l'id de l'établissement
        $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->findOneBy(
            array('etablissement' => $id, 'id' => $idCommentaire)
        );

        $em->remove($commentaire);
        $em->flush();

        return $this->redirect($this->generateUrl('etablissement_commentaires', array('id' => $id)));
    }

    /**
     * @Route("/etablissement/commune/{id}/carte", name="commune_carte")
     */
    public function showCarte(String $id)
    {
        $etablissements = $this->getDoctrine()->getRepository(Etablissement::class)->findByCommuneForMap($id);

        return $this->render('etablissement/carte.html.twig', array('etablissements' => $etablissements));
    }
}

