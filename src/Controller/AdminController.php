<?php

namespace App\Controller;

use App\Entity\Insurance;
use App\Entity\InsurancePrice;
use App\Form\InsuranceEditType;
use App\Form\InsurancePriceEditType;
use App\Repository\InsuranceRepository;
use App\Repository\InsurancePriceRepository;
use App\Util\FakeTranslator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function indexAction()
    {
        return $this->render('admin/action/index.html.twig');
    }

    /**
     * @Route("/prices", name="admin_price_list")
     */
    public function priceListAction(InsurancePriceRepository $inusrancePriceRepository)
    {
        return $this->render('admin/action/price/list.html.twig', [
            'prices' => $inusrancePriceRepository->findAll()
        ]);
    }

    /**
     * @Route("/price/edit/{inusrancePrice}", name="admin_price_edit")
     */
    public function priceEditAction(InsurancePrice $inusrancePrice, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(InsurancePriceEditType::class, $inusrancePrice)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', (new FakeTranslator())->trans('admin.price.edit.flush.success'));
            return $this->redirectToRoute('admin_price_list');
        }

        return $this->render('admin/action/price/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/insurances", name="admin_insurance_list")
     */
    public function insuranceListAction(InsuranceRepository $insuranceRepository)
    {
        return $this->render('admin/action/insurance/list.html.twig', [
            'insurances' => $insuranceRepository->findAll()
        ]);
    }

    /**
     * @Route("/insurance/edit/{insurance}", name="admin_insurance_edit")
     */
    public function insuranceEditAction(Insurance $insurance, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(InsuranceEditType::class, $insurance)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', (new FakeTranslator())->trans('admin.insurance.edit.flash.success'));
            return $this->redirectToRoute('admin_insurance_list');
        }

        return $this->render('admin/action/insurance/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/insurance/remove/{insurance}", name="admin_insurance_remove")
     */
    public function insuranceRemoveAction(Insurance $insurance, EntityManagerInterface $em)
    {
        $em->remove($insurance);
        $em->flush();
        $this->addFlash('success', (new FakeTranslator())->trans('admin.insurance.remove.flash.success'));
        return $this->redirectToRoute('admin_insurance_list');
    }
}