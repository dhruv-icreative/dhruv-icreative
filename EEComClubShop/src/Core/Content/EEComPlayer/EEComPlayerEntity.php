<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComPlayer;

use EECom\ClubShop\Core\Content\EEComPlayingPosition\EEComPlayingPositionCollection;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer\EEComTeamPlayerEntity;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Content\Product\ProductCollection;
use Shopware\Core\Content\ProductStream\ProductStreamEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Country\CountryEntity;

class EEComPlayerEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string|null
     */
    protected $lastName;

    /**
     * @var string|null
     */
    protected $firstName;

    /**
     * @var string|null
     */
    protected $nickName;

    /**
     * @var bool|null
     */
    protected $active;

    /**
     * @var bool|null
     */
    protected $hocMember;

    /**
     * @var bool|null
     */
    protected $playerFlockAvailable;

    /**
     * @var string|null
     */
    protected $playerPictureMediaId;

    /**
     * @var string|null
     */
    protected $street;

    /**
     * @var int|null
     */
    protected $number;

    /**
     * @var string|null
     */
    protected $zipcode;

    /**
     * @var string|null
     */
    protected $city;

    /**
     * @var string
     */
    protected $countryId;

    /**
     * @var string|null
     */
    protected $phone;

    /**
     * @var string|null
     */
    protected $gender;

    /**
     * @var string|null
     */
    protected $nationId;

    /**
     * @var string|null
     */
    protected $email1;

    /**
     * @var string|null
     */
    protected $email2;

    /**
     * @var \DateTimeInterface|null
     */
    protected $dob;

    /**
     * @var int|null
     */
    protected $favouritePlayerNumber;

    /**
     * @var string|null
     */
    protected $playerPassNumber;

    /**
     * @var string|null
     */
    protected $playingFoot;

    /**
     * @var string|null
     */
    protected $facebookUrl;

    /**
     * @var string|null
     */
    protected $instagramUrl;

    /**
     * @var string|null
     */
    protected $snapchatUrl;

    /**
     * @var string|null
     */
    protected $teamId;

    /**
     * @var string|null
     */
    protected $profession;

    /**
     * @var int|null
     */
    protected $teamPlayerNumber;

    /**
     * @var \DateTimeInterface|null
     */
    protected $clubMemberSince;

    /**
     * @var string|null
     */
    protected $previousClub;

    /**
     * @var string|null
     */
    protected $jerseySize;

    /**
     * @var string|null
     */
    protected $shortSize;

    /**
     * @var float|null
     */
    protected $shoeSize;

    /**
     * @var int|null
     */
    protected $height;

    /**
     * @var string
     */
    protected $productAssignmentType;

    /**
     * @var string|null
     */
    protected $productStreamId;

    /**
     * @var MediaEntity|null
     */
    protected $playerPicture;

    /**
     * @var CountryEntity|null
     */
    protected $country;

    /**
     * @var CountryEntity|null
     */
    protected $nation;

    /**
     * @var ProductCollection|null
     */
    protected $products;

    /**
     * @var ProductStreamEntity|null
     */
    protected $productStream;

    /**
     * @var EEComTeamPlayerEntity|null
     */
    protected $playerTeam;

    /**
     * @var ProductCollection|null
     */
    protected $shoeProducts;

    /**
     * @var EEComPlayingPositionCollection|null
     */
    protected $onePlayingPositions;

    /**
     * @var EEComPlayingPositionCollection|null
     */
    protected $twoPlayingPositions;

    /**
     * @var EEComPlayingPositionCollection|null
     */
    protected $teamPositions;

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getNickName(): ?string
    {
        return $this->nickName;
    }

    /**
     * @param string|null $nickName
     */
    public function setNickName(?string $nickName): void
    {
        $this->nickName = $nickName;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     */
    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return bool|null
     */
    public function getHocMember(): ?bool
    {
        return $this->hocMember;
    }

    /**
     * @param bool|null $hocMember
     */
    public function setHocMember(?bool $hocMember): void
    {
        $this->hocMember = $hocMember;
    }

    /**
     * @return bool|null
     */
    public function getPlayerFlockAvailable(): ?bool
    {
        return $this->playerFlockAvailable;
    }

    /**
     * @param bool|null $playerFlockAvailable
     */
    public function setPlayerFlockAvailable(?bool $playerFlockAvailable): void
    {
        $this->playerFlockAvailable = $playerFlockAvailable;
    }

    /**
     * @return string|null
     */
    public function getPlayerPictureMediaId(): ?string
    {
        return $this->playerPictureMediaId;
    }

    /**
     * @param string|null $playerPictureMediaId
     */
    public function setPlayerPictureMediaId(?string $playerPictureMediaId): void
    {
        $this->playerPictureMediaId = $playerPictureMediaId;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     */
    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     */
    public function setZipcode(?string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getNationId(): ?string
    {
        return $this->nationId;
    }

    /**
     * @param string|null $nationId
     */
    public function setNationId(?string $nationId): void
    {
        $this->nationId = $nationId;
    }

    /**
     * @return string|null
     */
    public function getEmail1(): ?string
    {
        return $this->email1;
    }

    /**
     * @param string|null $email1
     */
    public function setEmail1(?string $email1): void
    {
        $this->email1 = $email1;
    }

    /**
     * @return string|null
     */
    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    /**
     * @param string|null $email2
     */
    public function setEmail2(?string $email2): void
    {
        $this->email2 = $email2;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    /**
     * @param \DateTimeInterface|null $dob
     */
    public function setDob(?\DateTimeInterface $dob): void
    {
        $this->dob = $dob;
    }

    /**
     * @return int|null
     */
    public function getFavouritePlayerNumber(): ?int
    {
        return $this->favouritePlayerNumber;
    }

    /**
     * @param int|null $favouritePlayerNumber
     */
    public function setFavouritePlayerNumber(?int $favouritePlayerNumber): void
    {
        $this->favouritePlayerNumber = $favouritePlayerNumber;
    }

    /**
     * @return string|null
     */
    public function getPlayerPassNumber(): ?string
    {
        return $this->playerPassNumber;
    }

    /**
     * @param string|null $playerPassNumber
     */
    public function setPlayerPassNumber(?string $playerPassNumber): void
    {
        $this->playerPassNumber = $playerPassNumber;
    }

    /**
     * @return string|null
     */
    public function getPlayingFoot(): ?string
    {
        return $this->playingFoot;
    }

    /**
     * @param string|null $playingFoot
     */
    public function setPlayingFoot(?string $playingFoot): void
    {
        $this->playingFoot = $playingFoot;
    }

    /**
     * @return string|null
     */
    public function getFacebookUrl(): ?string
    {
        return $this->facebookUrl;
    }

    /**
     * @param string|null $facebookUrl
     */
    public function setFacebookUrl(?string $facebookUrl): void
    {
        $this->facebookUrl = $facebookUrl;
    }

    /**
     * @return string|null
     */
    public function getInstagramUrl(): ?string
    {
        return $this->instagramUrl;
    }

    /**
     * @param string|null $instagramUrl
     */
    public function setInstagramUrl(?string $instagramUrl): void
    {
        $this->instagramUrl = $instagramUrl;
    }

    /**
     * @return string|null
     */
    public function getSnapchatUrl(): ?string
    {
        return $this->snapchatUrl;
    }

    /**
     * @param string|null $snapchatUrl
     */
    public function setSnapchatUrl(?string $snapchatUrl): void
    {
        $this->snapchatUrl = $snapchatUrl;
    }

    /**
     * @return string|null
     */
    public function getTeamId(): ?string
    {
        return $this->teamId;
    }

    /**
     * @param string|null $teamId
     */
    public function setTeamId(?string $teamId): void
    {
        $this->teamId = $teamId;
    }

    /**
     * @return string|null
     */
    public function getProfession(): ?string
    {
        return $this->profession;
    }

    /**
     * @param string|null $profession
     */
    public function setProfession(?string $profession): void
    {
        $this->profession = $profession;
    }

    /**
     * @return int|null
     */
    public function getTeamPlayerNumber(): ?int
    {
        return $this->teamPlayerNumber;
    }

    /**
     * @param int|null $teamPlayerNumber
     */
    public function setTeamPlayerNumber(?int $teamPlayerNumber): void
    {
        $this->teamPlayerNumber = $teamPlayerNumber;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getClubMemberSince(): ?\DateTimeInterface
    {
        return $this->clubMemberSince;
    }

    /**
     * @param \DateTimeInterface|null $clubMemberSince
     */
    public function setClubMemberSince(?\DateTimeInterface $clubMemberSince): void
    {
        $this->clubMemberSince = $clubMemberSince;
    }

    /**
     * @return string|null
     */
    public function getPreviousClub(): ?string
    {
        return $this->previousClub;
    }

    /**
     * @param string|null $previousClub
     */
    public function setPreviousClub(?string $previousClub): void
    {
        $this->previousClub = $previousClub;
    }

    /**
     * @return string|null
     */
    public function getJerseySize(): ?string
    {
        return $this->jerseySize;
    }

    /**
     * @param string|null $jerseySize
     */
    public function setJerseySize(?string $jerseySize): void
    {
        $this->jerseySize = $jerseySize;
    }

    /**
     * @return string|null
     */
    public function getShortSize(): ?string
    {
        return $this->shortSize;
    }

    /**
     * @param string|null $shortSize
     */
    public function setShortSize(?string $shortSize): void
    {
        $this->shortSize = $shortSize;
    }

    /**
     * @return float|null
     */
    public function getShoeSize(): ?float
    {
        return $this->shoeSize;
    }

    /**
     * @param float|null $shoeSize
     */
    public function setShoeSize(?float $shoeSize): void
    {
        $this->shoeSize = $shoeSize;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int|null $height
     */
    public function setHeight(?int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getProductAssignmentType(): string
    {
        return $this->productAssignmentType;
    }

    /**
     * @param string $productAssignmentType
     */
    public function setProductAssignmentType(string $productAssignmentType): void
    {
        $this->productAssignmentType = $productAssignmentType;
    }

    /**
     * @return string|null
     */
    public function getProductStreamId(): ?string
    {
        return $this->productStreamId;
    }

    /**
     * @param string|null $productStreamId
     */
    public function setProductStreamId(?string $productStreamId): void
    {
        $this->productStreamId = $productStreamId;
    }

    /**
     * @return MediaEntity|null
     */
    public function getPlayerPicture(): ?MediaEntity
    {
        return $this->playerPicture;
    }

    /**
     * @param MediaEntity|null $playerPicture
     */
    public function setPlayerPicture(?MediaEntity $playerPicture): void
    {
        $this->playerPicture = $playerPicture;
    }

    /**
     * @return CountryEntity|null
     */
    public function getCountry(): ?CountryEntity
    {
        return $this->country;
    }

    /**
     * @param CountryEntity|null $country
     */
    public function setCountry(?CountryEntity $country): void
    {
        $this->country = $country;
    }

    /**
     * @return CountryEntity|null
     */
    public function getNation(): ?CountryEntity
    {
        return $this->nation;
    }

    /**
     * @param CountryEntity|null $nation
     */
    public function setNation(?CountryEntity $nation): void
    {
        $this->nation = $nation;
    }

    /**
     * @return ProductCollection|null
     */
    public function getProducts(): ?ProductCollection
    {
        return $this->products;
    }

    /**
     * @param ProductCollection $products
     */
    public function setProducts(ProductCollection $products): void
    {
        $this->products = $products;
    }

    /**
     * @return ProductStreamEntity|null
     */
    public function getProductStream(): ?ProductStreamEntity
    {
        return $this->productStream;
    }

    /**
     * @param ProductStreamEntity|null $productStream
     */
    public function setProductStream(?ProductStreamEntity $productStream): void
    {
        $this->productStream = $productStream;
    }

    /**
     * @return EEComTeamPlayerEntity|null
     */
    public function getPlayerTeam(): ?EEComTeamPlayerEntity
    {
        return $this->playerTeam;
    }

    /**
     * @param EEComTeamPlayerEntity|null $playerTeam
     */
    public function setPlayerTeam(?EEComTeamPlayerEntity $playerTeam): void
    {
        $this->playerTeam = $playerTeam;
    }

    /**
     * @return ProductCollection|null
     */
    public function getShoeProducts(): ?ProductCollection
    {
        return $this->shoeProducts;
    }

    /**
     * @param ProductCollection $shoeProducts
     */
    public function setShoeProducts(ProductCollection $shoeProducts): void
    {
        $this->shoeProducts = $shoeProducts;
    }

    /**
     * @return EEComPlayingPositionCollection|null
     */
    public function getOnePlayingPositions(): ?EEComPlayingPositionCollection
    {
        return $this->onePlayingPositions;
    }

    /**
     * @param EEComPlayingPositionCollection $onePlayingPositions
     */
    public function setOnePlayingPositions(EEComPlayingPositionCollection $onePlayingPositions): void
    {
        $this->onePlayingPositions = $onePlayingPositions;
    }

    /**
     * @return EEComPlayingPositionCollection|null
     */
    public function getTwoPlayingPositions(): ?EEComPlayingPositionCollection
    {
        return $this->twoPlayingPositions;
    }

    /**
     * @param EEComPlayingPositionCollection $twoPlayingPositions
     */
    public function setTwoPlayingPositions(EEComPlayingPositionCollection $twoPlayingPositions): void
    {
        $this->twoPlayingPositions = $twoPlayingPositions;
    }

    /**
     * @return EEComPlayingPositionCollection|null
     */
    public function getTeamPositions(): ?EEComPlayingPositionCollection
    {
        return $this->teamPositions;
    }

    /**
     * @param EEComPlayingPositionCollection $teamPositions
     */
    public function setTeamPositions(EEComPlayingPositionCollection $teamPositions): void
    {
        $this->teamPositions = $teamPositions;
    }
}
