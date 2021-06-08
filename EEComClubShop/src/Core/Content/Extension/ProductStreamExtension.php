<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\Extension;

use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Content\ProductStream\ProductStreamDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductStreamExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return ProductStreamDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField(
                'teamProductStream',
                EEComTeamDefinition::class,
                'product_stream_id',
                'id'
            )
        );

        $collection->add(
            new OneToManyAssociationField(
                'playerProductStream',
                EEComPlayerDefinition::class,
                'product_stream_id',
                'id'
            )
        );
    }
}
