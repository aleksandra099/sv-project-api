<?php

namespace AppBundle\EventListener;

use AppBundle\Configuration\QueryType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class QueryTypeEventListener
{
    protected $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();

        if(!$request->attributes->has('_query_type')){
            return;
        }

        /** @var QueryType $queryType */
        $queryType = $request->attributes->get('_query_type');

        $type = $queryType->getType();

        if (!$type) {
            return;
        }

        $formOptions = [
            'csrf_protection' => false,
            'method'          => 'GET',
        ];
        //setDefaultOptions ,buildForm
        $form = $this->formFactory->createNamed('', $type, null, $formOptions);

        $form->submit($request->query->all(), false);

        if (!$form->isSubmitted()) {
            throw new \RuntimeException('Forms registered through QueryType annotation should always be submitted upon request');
        }

        if (!$form->isValid()) {
            throw (new BadRequestHttpException('Invalid form!'));
        }

        $request->attributes->set($queryType->getData(), $form->getData());
        $request->attributes->set('formType', $form);
    }
}