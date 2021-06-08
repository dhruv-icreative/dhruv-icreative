<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\Extension;

use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTranslation\EEComClubTranslationDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamTranslation\EEComTeamTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Extension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;

class LanguageExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return LanguageDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField(
                'eecomClubTranslation',
                EEComClubTranslationDefinition::class,
                'language_id',
                'id'
            ))->addFlags(new CascadeDelete(), new Extension())
        );

        $collection->add(
            (new OneToManyAssociationField(
                'eecomTeamTranslation',
                EEComTeamTranslationDefinition::class,
                'language_id',
                'id'
            ))->addFlags(new CascadeDelete(), new Extension())
        );
    }
}
