<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Category;
use App\Form\LibraryType;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/library")
 */
class LibraryController extends AbstractController
{
    /**
     * @Route("/", name="library_index", methods={"GET"})
     */
    public function index(LibraryRepository $libraryRepository): Response
    {

        $category = $this->getDoctrine()  
        ->getRepository(Category::class)
        ->findAll();

        return $this->render('library/index.html.twig', [
            'libraries' => $libraryRepository->findAll(),
            'categorys'=>$category
        
        ]);
    }

    /**
     * @Route("/new", name="library_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $library = new Library();
        $form = $this->createForm(LibraryType::class, $library);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $cover = $form->get('cover')->getData();
            $book=$form->get('book')->getData();
            $entityManager = $this->getDoctrine()->getManager();
            if($cover){
                $library->setCover($this->uploadFile($cover, $slugger, 'cover_directory'));
            }
            if($book){
                $library->setBook($this->uploadFile($book, $slugger, 'book_directory'));
            }
            $entityManager->persist($library);
            $entityManager->flush();

            return $this->redirectToRoute('library_index');
        }

        return $this->render('library/new.html.twig', [
            'library' => $library,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="library_show", methods={"GET"})
     */
    public function show(Library $library): Response
    {
        $category = $this->getDoctrine()  
        ->getRepository(Category::class)
        ->findAll();
        
        return $this->render('library/show.html.twig', [
            'library' => $library,
            'categorys'=>$category
        ]);
    }

    /**
     * @Route("/{id}/edit", name="library_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Library $library): Response
    {
        
        $form = $this->createForm(LibraryType::class, $library);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('library_index');
        }

        return $this->render('library/edit.html.twig', [
            'library' => $library,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="library_delete", methods={"POST"})
     */
    public function delete(Request $request, Library $library): Response
    {
        if ($this->isCsrfTokenValid('delete'.$library->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($library);
            $entityManager->flush();
        }

        return $this->redirectToRoute('library_index');
    }



    public function uploadFile($file, $slugger, $targetDirectory){

        if ($file) {

            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter($targetDirectory),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            return $newFilename;

        }
    }
}
