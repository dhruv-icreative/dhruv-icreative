<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\Extension;

use EECom\ClubShop\Core\Content\EEComClub\EEComClubDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Extension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\CountryDefinition;

class CountryExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return CountryDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField(
                'clubCountry',
                EEComClubDefinition::class,
                'country_id',
                'id'
            ))->addFlags(new CascadeDelete(), new Extension())
        );

        $collection->add(
            (new OneToManyAssociationField(
                'playerCountry',
                EEComPlayerDefinition::class,
                'country_id',
                'id'
            ))->addFlags(new CascadeDelete(), new Extension())
        );

        $collection->add(
            (new OneToManyAssociationField(
                'playerNation',
                EEComPlayerDefinition::class,
                'nation_id',
                'id'
            ))->addFlags(new CascadeDelete(), new Extension())
        );
    }
}
