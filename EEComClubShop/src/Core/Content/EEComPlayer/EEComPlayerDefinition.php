<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayer;

use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerPlayingPosition1\EEComPlayerPlayingPosition1Definition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerPlayingPosition2\EEComPlayerPlayingPosition2Definition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerProduct\EEComPlayerProductDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerShoe\EEComPlayerShoeDefinition;
use EECom\ClubShop\Core\Content\EEComPlayer\Aggregate\EEComPlayerTeamPosition\EEComPlayerTeamPositionDefinition;
use EECom\ClubShop\Core\Content\EEComPlayingPosition\EEComPlayingPositionDefinition;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer\EEComTeamPlayerDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Content\ProductStream\ProductStreamDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\EmailField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\CountryDefinition;

class EEComPlayerDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'eecom_player';

    public const GENDER_TYPE = 'male';

    public const PLAYING_FOOT = 'right';

    public const PRODUCT_ASSIGNMENT_TYPE_PRODUCT = 'product';

    public const PRODUCT_ASSIGNMENT_TYPE_PRODUCT_STREAM = 'product_stream';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return EEComPlayerCollection::class;
    }

    public function getEntityClass(): string
    {
        return EEComPlayerEntity::class;
    }

    public function getDefaults(): array
    {
        return [
            'active' => true,
            'gender' => self::GENDER_TYPE,
            'playingFoot' => self::PLAYING_FOOT,
            'productAssignmentType' => self::PRODUCT_ASSIGNMENT_TYPE_PRODUCT
        ];
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            new StringField('last_name', 'lastName'),
            new StringField('first_name', 'firstName'),
            new StringField('nick_name', 'nickName'),
            new BoolField('active', 'active'),
            new BoolField('hoc_member', 'hocMember'),
            new BoolField('player_flock_available', 'playerFlockAvailable'),
            new FkField('player_picture_media_id', 'playerPictureMediaId', MediaDefinition::class, 'id'),
            new StringField('street', 'street'),
            new IntField('number', 'number'),
            new StringField('zipcode', 'zipcode'),
            new StringField('city', 'city'),
            (new FkField('country_id', 'countryId', CountryDefinition::class, 'id'))->addFlags(new Required()),
            new StringField('phone', 'phone'),
            new StringField('gender', 'gender'),
            new FkField('nation_id', 'nationId', CountryDefinition::class, 'id'),
            new EmailField('email1', 'email1'),
            new EmailField('email2', 'email2'),
            new DateField('dob', 'dob'),
            new IntField('favourite_player_number', 'favouritePlayerNumber'),
            new StringField('player_pass_number', 'playerPassNumber'),
            new StringField('playing_foot', 'playingFoot'),
            new StringField('facebook_url', 'facebookUrl'),
            new StringField('instagram_url', 'instagramUrl'),
            new StringField('snapchat_url', 'snapchatUrl'),
            // Team&Club Data Tab
            new StringField('profession', 'profession'),
            new IntField('team_player_number', 'teamPlayerNumber'),
            new DateField('club_member_since', 'clubMemberSince'),
            new StringField('previous_club', 'previousClub'),
            new StringField('jersey_size', 'jerseySize'),
            new StringField('short_size', 'shortSize'),
            new FloatField('shoe_size', 'shoeSize'),
            new IntField('height', 'height'),
            // Product assignment tab
            (new StringField('product_assignment_type', 'productAssignmentType'))->addFlags(new Required()),
            new FkField('product_stream_id', 'productStreamId', ProductStreamDefinition::class),

            // associations
            new ManyToOneAssociationField('playerPicture', 'player_picture_media_id', MediaDefinition::class, 'id'),
            new ManyToOneAssociationField('country', 'country_id', CountryDefinition::class, 'id'),
            new ManyToOneAssociationField('nation', 'nation_id', CountryDefinition::class, 'id'),
            new ManyToManyAssociationField('products', ProductDefinition::class, EEComPlayerProductDefinition::class, 'eecom_player_id', 'product_id'),
            new ManyToOneAssociationField('productStream', 'product_stream_id', ProductStreamDefinition::class, 'id', false),
            new OneToOneAssociationField('playerTeam', 'id', 'eecom_player_id', EEComTeamPlayerDefinition::class),
            new ManyToManyAssociationField('shoeProducts', ProductDefinition::class,EEComPlayerShoeDefinition::class, 'eecom_player_id', 'product_id'),
            new ManyToManyAssociationField('onePlayingPositions', EEComPlayingPositionDefinition::class, EEComPlayerPlayingPosition1Definition::class, 'eecom_player_id', 'eecom_playing_position_id'),
            new ManyToManyAssociationField('twoPlayingPositions', EEComPlayingPositionDefinition::class, EEComPlayerPlayingPosition2Definition::class, 'eecom_player_id', 'eecom_playing_position_id'),
            new ManyToManyAssociationField('teamPositions', EEComPlayingPositionDefinition::class, EEComPlayerTeamPositionDefinition::class, 'eecom_player_id', 'eecom_playing_position_id')
        ]);
    }
}
