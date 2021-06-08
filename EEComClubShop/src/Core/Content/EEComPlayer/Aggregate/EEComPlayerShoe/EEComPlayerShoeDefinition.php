<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerShoe;

use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;

class EEComPlayerShoeDefinition extends MappingEntityDefinition
{
    public const ENTITY_NAME = 'eecom_player_shoe';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('eecom_player_id', 'eecomPlayerId', EEComPlayerDefinition::class, 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('product_id', 'productId', ProductDefinition::class, 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            new ManyToOneAssociationField('player', 'eecom_player_id', EEComPlayerDefinition::class, 'id'),
            new ManyToOneAssociationField('shoeProduct', 'product_id', ProductDefinition::class, 'id'),
            new CreatedAtField()
        ]);
    }
}
