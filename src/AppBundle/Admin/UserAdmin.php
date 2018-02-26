<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-26
 * Time: 11:20
 */

namespace AppBundle\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class UserAdmin extends AbstractAdmin {
    /**
     * Skonfigurowanie pól dla formularza edycji/tworzenia obiektu
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', 'text')
            ->add('email', 'textarea')
            ->add('enabled', 'checkbox')
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
            ->add('username')
            ->add('email')
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
            ->addIdentifier('username')
            ->add('email')
            ->add('enabled')
            ->add('last_login', 'datetime', array(
                'label' => 'Last login',
                'pattern' => 'dd MMM y G'
            ))
        ;
    }
}