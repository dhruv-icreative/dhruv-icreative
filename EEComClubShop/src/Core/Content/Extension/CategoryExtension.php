<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\Extension;

use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Content\Category\CategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class CategoryExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return CategoryDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField(
                'teamCategory',
                EEComTeamDefinition::class,
                'category_id',
                'id'
            ))
        );
    }
}
