<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComFont;

use EECom\ClubShop\Core\Content\EEComClub\EEComClubDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class EEComFontDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_font';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return EEComFontCollection::class;
    }

    public function getEntityClass(): string
    {
        return EEComFontEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new StringField('name', 'name'))->addFlags(new Required()),
            new StringField('font_url', 'fontUrl'),
            new StringField('file_name', 'fileName'),
            new StringField('file_type', 'fileType'),
            new OneToManyAssociationField('headlineFontClubs', EEComClubDefinition::class, 'headline_font_id', 'id'),
            new OneToManyAssociationField('textFontClubs', EEComClubDefinition::class, 'text_font_id', 'id'),
        ]);
    }
}
