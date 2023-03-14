<?php

namespace App\Controller;

use App\Entity\NoteDeFrais;
use App\Form\AfficherNoteType;
use App\Form\AnnulerSortieType;
use App\Form\NoteDeFraisType;
use App\Form\SupprimerNoteType;
use App\Repository\NoteDeFraisRepository;
use App\Service\PdfService;
use App\Service\UploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/note')]
class NoteDeFraisController extends AbstractController
{
    #[Route('/index', name: 'note_index', methods: ['GET'])]
    public function index(NoteDeFraisRepository $noteDeFraisRepository): Response
    {
        return $this->render('note_de_frais/index.html.twig', [
            'note_de_frais' => $noteDeFraisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NoteDeFraisRepository $noteDeFraisRepository, UploaderService $uploaderService): Response
    {
        $noteDeFrai = new NoteDeFrais();
        $createNoteform = $this->createForm(NoteDeFraisType::class, $noteDeFrai);
        $createNoteform->handleRequest($request);

        if ($createNoteform->isSubmitted() && $createNoteform->isValid()) {
            /**  @var UploadedFile $uploadedFile */
            $uploadedFile = $createNoteform->get('fichier')->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderService->upload($uploadedFile);
                $noteDeFrai->setFichier($newFilename);
            }
            $noteDeFraisRepository->add($noteDeFrai, true);

            return $this->redirectToRoute('note_show', ['id'=>$noteDeFrai->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('note_de_frais/new.html.twig', [
            'note_de_frai' => $noteDeFrai,
            'createNoteform' => $createNoteform->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'note_show', methods: ['GET'])]
    public function show($id, NoteDeFraisRepository $noteDeFraisRepository, Request $request): Response
    {
        $noteDeFrai = $noteDeFraisRepository->find($id);
        $form = $this->createForm(AfficherNoteType::class, $noteDeFrai);
        $form->handleRequest($request);

        return $this->render('note_de_frais/show.html.twig', [
            'note_de_frais.id' => $noteDeFrai,
            'afficherNoteform' => $form->createView(),
        ]);
    }

    #[Route('/pdf/{id}', name: 'note.pdf')]
    public function generatePdfNote(NoteDeFrais $noteDeFrai = null, PdfService $pdf)
    {
        $html = $this->render('note_de_frais/show.html.twig', [
            'noteDeFrais' => $noteDeFrai
        ]);

        $pdf->showPdfFile($html);
    }

    #[Route('/edit/{id}', name: 'note_edit')]
    public function edit($id, Request $request, NoteDeFrais $noteDeFrai, NoteDeFraisRepository $noteDeFraisRepository): Response
    {
        $noteDeFrai = $noteDeFraisRepository->find($id);
        $modifierNoteform = $this->createForm(NoteDeFraisType::class, $noteDeFrai);
        $modifierNoteform->handleRequest($request);

        if ($modifierNoteform->isSubmitted() && $modifierNoteform->isValid()) {
            $noteDeFraisRepository->add($noteDeFrai, true);

            $this->addFlash('succès', 'Note de frais modifiée');
            return $this->redirect($this->generateUrl('note_index'));
        }

        return $this->render('note_de_frais/edit.html.twig', [
            'id' => $noteDeFrai,
            'form' => $modifierNoteform->createView(),
        ]);
    }

    #[Route('/supprimer/{id}', name: 'note_delete')]
    public function delete(Request $request, NoteDeFrais $noteDeFrai, NoteDeFraisRepository $noteDeFraisRepository): Response
    {
        $supprimerUneNote = $this->createForm(SupprimerNoteType::class, $noteDeFrai);
        $supprimerUneNote->handleRequest($request);

        if ($supprimerUneNote->isSubmitted() && $supprimerUneNote->isValid()) {

            $noteDeFraisRepository->remove($noteDeFrai, true);

            //message
            $this->addFlash('succèc', 'Note de frais supprimée');
            return $this->redirect($this->generateUrl('note_index'));
        }
        return $this->render('note_de_frais/supprimerUneNote.html.twig', [
            'id' => $noteDeFrai,
            'supprimerUneNote' => $supprimerUneNote->createView(),
        ]);
        /*if ($this->isCsrfTokenValid('delete'.$noteDeFrai->getId(), $request->request->get('_token'))) {
            $noteDeFraisRepository->remove($noteDeFrai, true);

            $this->addFlash('succès', 'Note de frais supprimée');

        }

        return $this->redirectToRoute('note_index', [], Response::HTTP_SEE_OTHER);*/
    }
}
