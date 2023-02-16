<?php

namespace App\Controller\Admin;

use App\Entity\SuiteHotel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SuiteHotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SuiteHotel::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
