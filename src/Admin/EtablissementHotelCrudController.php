<?php

namespace App\Controller\Admin;

use App\Entity\EtablissementHotel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EtablissementHotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EtablissementHotel::class;
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
