<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-24
 * Time: 17:05
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FlatAdmin extends AbstractAdmin
{
    /**
     * Skonfigurowanie pól dla formularza edycji/tworzenia obiektu
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('price', 'number')
            ->add('area', 'number')
            ->add('bedrooms', 'number')
            ->add('bathrooms', 'number')
            ->add('garages', 'number')
            ->add('expiresAt', 'datetime')
        ;
    }

    /**
     * Pola dla filtrów wyszukiwarki.
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('expiresAt')
        ;
    }

    /**
     * Skonfigurowanie pól do wylistowania na widoku listy.
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->addIdentifier('price')
            ->addIdentifier('area')
            ->addIdentifier('bedrooms')
            ->addIdentifier('bathrooms')
            ->addIdentifier('expiresAt')
        ;
    }
}