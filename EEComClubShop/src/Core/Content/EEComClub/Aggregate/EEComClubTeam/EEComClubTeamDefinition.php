<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam;

// TODO: REMOVE OBSOLETE DEFINITION
use EECom\ClubShop\Core\Content\EEComClub\EEComClubDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\EEComTeamDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class EEComClubTeamDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_club_team';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return EEComClubTeamCollection::class;
    }

    public function getEntityClass(): string
    {
        return EEComClubTeamEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('eecom_club_id', 'eecomClubId', EEComClubDefinition::class, 'id'))->addFlags(new Required()),
            (new FkField('eecom_team_id', 'eecomTeamId', EEComTeamDefinition::class, 'id'))->addFlags(new Required()),
            new ManyToOneAssociationField('club', 'eecom_club_id', EEComClubDefinition::class, 'id'),
            new OneToOneAssociationField('team', 'eecom_team_id', 'id', EEComTeamDefinition::class, false)
        ]);
    }
}
