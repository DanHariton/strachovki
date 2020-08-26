<?php

namespace App\Controller;

use App\Entity\ClientsPhones;
use App\Entity\Insurance;
use App\Form\ClientPhoneType;
use App\Form\InsuranceType;
use App\Util\FakeTranslator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="page_index")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $clientPhones = new ClientsPhones();
        $form = $this->createForm(ClientPhoneType::class, $clientPhones);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientPhones = $form->getData();
            $em->persist($clientPhones);
            $em->flush();

            $this->addFlash('success', (new FakeTranslator())->trans('page.applyClientPhone.flash.success'));
            return $this->redirectToRoute('page_index');
        }

        return $this->render('page/action/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/insuarence-maxima-options", name="page_insurance_maxima_options")
     */
    public function insuranceMaximaOptions()
    {

        return $this->render('page/action/insurance_maxima_options.html.twig');
    }

    /**
     * @Route("/insurance-for-foreigners", name="page_insurance_options")
     */
    public function insuranceOptionsAction()
    {

        return $this->render('page/action/insurance_options.html.twig');
    }


    /**
     * @Route("/apply/{name}", name="page_apply_insurance", requirements={"name"="ergo|unica|pvzp|maxima"})
     */
    public function applyInsuranceAction($name, Request $request, EntityManagerInterface $em)
    {
        $insurance = new Insurance();
        $insurance->setInsuranceName($name);
        $form = $this->createForm(InsuranceType::class, $insurance)
         ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Insurance $insurance */
            $insurance = $form->getData();
            $em->persist($insurance);
            $em->flush();

            $this->addFlash('success', (new FakeTranslator())->trans('page.applyInsurance.flash.success'));
            return $this->redirectToRoute('page_index');
        }

        return $this->render('page/action/apply_insurance.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}