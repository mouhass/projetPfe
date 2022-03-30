<?php


namespace App\Controller;


use App\Entity\Job;
use App\Form\Type\jobCompositeType;
use App\Form\Type\jobCronType;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class jobController extends AbstractController
{
    public  $manager;

    public function __construct(EntityManagerInterface $manager )
    {
        $this->manager = $manager;
    }

    public function index( JobRepository $jobRepository)
    {
        $job = $jobRepository->findAll();
      return $this->render('tousJobs.html.twig',
          ['job'=>$job]
          );
    }


   public function details( int $id,JobRepository $jobRepository)
   {
        $job = $jobRepository->findOneBySomeField($id);
        return $this->render('job/details.html.twig', ['job'=>$job]);
   }

  public function modifier(Request $request,int $id, JobRepository $repository)
  {
      $job = $repository->findOneBySomeField($id);
      $form = $this->createForm(jobCronType::class,$job);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
          $em=$this->manager;
          $em->persist($job);
          $em->flush();
          $this->addFlash('success',"un job cron a ete ajouté avec succes");
          //une redirection vers une autre page
          return  $this-> redirectToRoute('index');
      }

      return $this->render('job/modifierJob.html.twig',[
          'jobForm'=>$form->createView()
      ]);
  }


    public function delete( int $id, JobRepository $repository){
        $property = $repository->findOneBySomeField($id);
        $em =$this->manager;
        $em->remove($property);
        $em->flush();
        return  $this-> redirectToRoute('index');
    }

    public function createJobCron(Request $request, EntityManagerInterface $entityManager)
    {
        $jobCron = new Job();
        $form = $this->createForm(jobCronType::class, $jobCron);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobCron);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('job/createJobCron.html.twig', [
            'jobCron' => $jobCron,
            'form' => $form->createView(),
        ]);
    }


    public function createJobComposite(Request $request, EntityManagerInterface $entityManager)
    {
        $jobCron = new Job();
        $form = $this->createForm(jobCompositeType::class, $jobCron);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobCron);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('job/createJobComposite.html.twig', [
            'jobCron' => $jobCron,
            'form' => $form->createView(),
        ]);
    }




}
