<?php

namespace App\Controller;

use App\Entity\BankReference;
use App\Entity\Insurance;
use App\Entity\InsurancePrice;
use App\Form\BankReferenceType;
use App\Form\InsuranceEditType;
use App\Form\InsurancePriceEditType;
use App\Repository\BankReferenceRepository;
use App\Repository\InsuranceRepository;
use App\Repository\InsurancePriceRepository;
use App\Util\FakeTranslator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        return $this->redirectToRoute('admin_insurance_list');
    }

    /**
     * @Route("/prices", name="admin_price_list")
     * @param InsurancePriceRepository $insurancePriceRepository
     * @return Response
     */
    public function priceListAction(InsurancePriceRepository $insurancePriceRepository)
    {
        return $this->render('admin/action/price/list.html.twig', [
            'prices' => $insurancePriceRepository->findAll()
        ]);
    }

    /**
     * @Route("/price/edit/{inusrancePrice}", name="admin_price_edit")
     * @param InsurancePrice $inusrancePrice
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function priceEditAction(InsurancePrice $inusrancePrice, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(InsurancePriceEditType::class, $inusrancePrice)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', (new FakeTranslator())->trans('admin.edit.flush.success'));
            return $this->redirectToRoute('admin_price_list');
        }

        return $this->render('admin/action/price/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/insurances", name="admin_insurance_list")
     * @param InsuranceRepository $insuranceRepository
     * @return Response
     */
    public function insuranceListAction(InsuranceRepository $insuranceRepository)
    {
        return $this->render('admin/action/insurance/list.html.twig', [
            'insurances' => $insuranceRepository->findBy(array(), array('id' => 'DESC'))
        ]);
    }

    /**
     * @Route("/insurance/edit/{insurance}", name="admin_insurance_edit")
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function insuranceEditAction(Insurance $insurance, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(InsuranceEditType::class, $insurance)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', (new FakeTranslator())->trans('admin.edit.flush.success'));
            return $this->redirectToRoute('admin_insurance_list');
        }

        return $this->render('admin/action/insurance/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/insurance/remove/{insurance}", name="admin_insurance_remove")
     * @param Insurance $insurance
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function insuranceRemoveAction(Insurance $insurance, EntityManagerInterface $em)
    {
        $em->remove($insurance);
        $em->flush();
        $this->addFlash('success', (new FakeTranslator())->trans('admin.insurance.remove.flash.success'));
        return $this->redirectToRoute('admin_insurance_list');
    }

    /**
     * @Route("/insurance/sent-to-client/toggle/{insurance}", name="admin_insurance_sent_to_client_toggle")
     * @param Insurance $insurance
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function insuranceSentToClientToggleAction(Insurance $insurance, EntityManagerInterface $em)
    {
        $insurance->setSentToClient(!$insurance->getSentToClient());
        $em->flush();
        return $this->redirectToRoute('admin_insurance_list');
    }

    /**
     * @Route("/inusrance/paid-to-insurance/toggle/{insurance}", name="admin_insurance_paid_to_insurance_toggle")
     * @param Insurance $insurance
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function paidToInsuranceCompanyToggleAction(Insurance $insurance, EntityManagerInterface $em)
    {
        $insurance->setPaidToInsuranceCompany(!$insurance->getPaidToInsuranceCompany());
        $em->flush();
        return $this->redirectToRoute('admin_insurance_list');
    }

    /**
     * @Route("/insured-number/list", name="admin_insured_number_list")
     * @param InsuranceRepository $insuranceRepository
     * @return Response
     */
    public function insuredNumberListAction(InsuranceRepository $insuranceRepository)
    {
        return $this->render('admin/action/insuredNumber/list.html.twig', [
            'insurances' => $insuranceRepository->findByInsuredNumberField()
        ]);
    }

    /**
     * @Route("/insurance/set-paid-status/success/toggle/{insurance}", name="admin_insurance_set_paid_status_success_toggle")
     * @param Insurance $insurance
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function setPaidStatusSuccessAction(Insurance $insurance, EntityManagerInterface $em)
    {
        $insurance->setStatus(Insurance::STATUS_PAYED_SUCCESS);
        $em->flush();
        return $this->redirectToRoute('admin_insurance_list');
    }

    /**
     * @Route("/bank-reference/list", name="admin_bank_reference_list")
     * @param BankReferenceRepository $bankReferenceRepository
     * @return Response
     */
    public function bankReferenceListAction(BankReferenceRepository $bankReferenceRepository)
    {
        return $this->render('admin/action/bankReference/list.html.twig', [
            'references' => $bankReferenceRepository->findBy(array(), array('id' => 'DESC'))
        ]);
    }

    /**
     * @Route("/bank-reference/toggle/{bankReference}", name="admin_bank_reference_toggle")
     * @param BankReference $bankReference
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function bankReferenceToggleAction(BankReference $bankReference, EntityManagerInterface $em)
    {
        if ($bankReference->getState() == BankReference::STATE_PROCESSED) {
            $bankReference->setState(BankReference::STATE_CANCELED);
        } else {
            $bankReference->setState(BankReference::STATE_PROCESSED);
        }

        if ($bankReference->getState() == BankReference::STATE_NEW) {
            $bankReference->setState(BankReference::STATE_PROCESSED);
        }

        $em->flush();
        return $this->redirectToRoute('admin_bank_reference_list');
    }
}