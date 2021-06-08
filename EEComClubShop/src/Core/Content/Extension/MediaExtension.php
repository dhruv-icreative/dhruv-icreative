<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\Extension;

use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubMedia\EEComClubMediaDefinition;
use EECom\ClubShop\Core\Content\EEComClub\EEComClubDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\EEComPlayerDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamMedia\EEComTeamMediaDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class MediaExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return MediaDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToManyAssociationField(
                'clubLogoSquare',
                EEComClubDefinition::class,
                'logo_square_id',
                'id'
            ))
        );

        $collection->add(
            (new OneToManyAssociationField(
                'clubLogoLandscape',
                EEComClubDefinition::class,
                'logo_landscape_id',
                'id'
            ))
        );

        $collection->add(
            (new OneToManyAssociationField(
                'clubCover',
                EEComClubDefinition::class,
                'media_id',
                'id'
            ))
        );

        $collection->add(
            (new ManyToManyAssociationField(
                'clubMedia',
                EEComClubDefinition::class,
                EEComClubMediaDefinition::class,
                'eecom_club_id',
                'media_id'
            ))
        );

        $collection->add(
            (new OneToManyAssociationField(
                'teamCover',
                EEComTeamDefinition::class,
                'media_id',
                'id'
            ))
        );

        $collection->add(
            (new ManyToManyAssociationField(
                'teamMedia',
                EEComTeamDefinition::class,
                EEComTeamMediaDefinition::class,
                'eecom_team_id',
                'media_id'
            ))
        );

        $collection->add(
            (new OneToManyAssociationField(
                'playerCover',
                EEComPlayerDefinition::class,
                'media_id',
                'id'
            ))
        );
    }
}
