<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use EECom\ClubShop\Core\Content\EEComClub\EEComClubDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CustomFields;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;

class EEComClubTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'eecom_club_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return EEComClubTranslationEntity::class;
    }

    public function getCollectionClass(): string
    {
        return EEComClubTranslationCollection::class;
    }

    public function getParentDefinitionClass(): string
    {
        return EEComClubDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('short_name', 'shortName'))->addFlags(new Required()),
            (new StringField('long_name', 'longName')),
            (new StringField('full_name', 'fullName')),
            (new StringField('department', 'department')),
            (new StringField('ground_name', 'groundName')),
            (new LongTextField('club_description', 'clubDescription'))->addFlags(new AllowHtml()),
            (new StringField('meta_title', 'metaTitle')),
            (new StringField('meta_description', 'metaDescription')),
            (new LongTextField('keywords', 'keywords')),
            new CustomFields(),
        ]);
    }
}
