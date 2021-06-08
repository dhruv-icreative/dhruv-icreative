<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\Extension;

use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerProduct\EEComPlayerProductDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerShoe\EEComPlayerShoeDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamProduct\EEComTeamProductDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Inherited;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new ManyToManyAssociationField(
                'teamProducts',
                EEComTeamDefinition::class,
                EEComTeamProductDefinition::class,
                'product_id',
                'eecom_team_id'
            ))->addFlags(new Inherited())
        );

        $collection->add(
            (new ManyToManyAssociationField(
                'playerProducts',
                EEComPlayerDefinition::class,
                EEComPlayerProductDefinition::class,
                'product_id',
                'eecom_player_id'
            ))->addFlags(new Inherited())
        );

        $collection->add(
            (new ManyToManyAssociationField(
                'playerShoeProducts',
                EEComPlayerDefinition::class,
                EEComPlayerShoeDefinition::class,
                'product_id',
                'eecom_player_id'
            ))->addFlags(new Inherited())
        );

        $collection->add(
            (new OneToManyAssociationField(
                'teaserProducts',
                EEComTeamDefinition::class,
                'teaser_product_id',
                'id'
            ))
        );
    }
}
