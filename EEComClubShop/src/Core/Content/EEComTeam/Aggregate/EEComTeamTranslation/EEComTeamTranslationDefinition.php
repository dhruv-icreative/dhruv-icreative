<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamTranslation;

use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CustomFields;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class EEComTeamTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'eecom_team_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return EEComTeamTranslationEntity::class;
    }

    public function getCollectionClass(): string
    {
        return EEComTeamTranslationCollection::class;
    }

    public function getParentDefinitionClass(): string
    {
        return EEComTeamDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('name', 'name'))->addFlags(new Required()),
            new StringField('ground_name', 'groundName'),
            (new LongTextField('team_description', 'teamDescription'))->addFlags(new AllowHtml()),
            new CustomFields()
        ]);
    }
}
