<?php

namespace App\Controller\Admin;

use App\Entity\Drinks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DrinksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Drinks::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name', 'name'),
            MoneyField::new('price', "Price")->setCurrency('EUR'),
            AssociationField::new('categorie'),
            ImageField::new('image', 'Image')->setBasePath('images/drinks')
                ->setUploadDir("public/images/drinks")
                ->setSortable(false),
            TextEditorField::new('Description', "description"),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),

        ];
    }
    
}
