<?php
namespace App\Controller;

use App\Entity\Property;
use App\Entity\Contact;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

/**
 *
 */
class PropertyController extends AbstractController
{

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
    * @Route("/biens", name="property.index")
    * @return Response
    */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
    * @param Property $property
    * @return Response
    */
    public function show(Property $property, string $slug, Request $request, ContactNotification $notification): Response
    {
        $property_slug = $property->getSlug();
        if ($property_slug !== $slug)
        {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property_slug
            ], 301);
        }

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé.');
            return $this->redirectToRoute('property.show', [
                'id'    => $property->getId(),
                'slug'  => $property_slug
            ]);
        }

        return $this->render('property/show.html.twig', [
            'property'      => $property,
            'current_menu'  => 'properties',
            'form'          => $form->createView(),
        ]);
    }
}
