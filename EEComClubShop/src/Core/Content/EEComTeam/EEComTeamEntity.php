<?php declare(strict_types=1);

namespace EECom\ClubShop\Core\Content\EEComTeam;

use EECom\ClubShop\Core\Content\EEComClub\Aggregate\EEComClubTeam\EEComClubTeamEntity;
use EECom\ClubShop\Core\Content\EEComLeague\EEComLeagueEntity;
use EECom\ClubShop\Core\Content\EEComLeagueRegion\EEComLeagueRegionEntity;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamPlayer\EEComTeamPlayerCollection;
use EECom\ClubShop\Core\Content\EEComTeam\Aggregate\EEComTeamTranslation\EEComTeamTranslationCollection;
use Shopware\Core\Content\Category\CategoryEntity;
use Shopware\Core\Content\Product\ProductCollection;
use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Content\ProductStream\ProductStreamEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Content\Media\MediaCollection;

class EEComTeamEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $categoryId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var bool|null
     */
    protected $active;

    /**
     * @var string
     */
    protected $profession;

    /**
     * @var string
     */
    protected $sportType;

    /**
     * @var string
     */
    protected $teamType;

    /**
     * @var string|null
     */
    protected $leagueId;

    /**
     * @var string|null
     */
    protected $leagueRegionId;

    /**
     * @var string|null
     */
    protected $groundName;

    /**
     * @var string|null
     */
    protected $teamDescription;

    /**
     * @var string
     */
    protected $productAssignmentType;

    /**
     * @var string|null
     */
    protected $productStreamId;

    /**
     * @var string|null
     */
    protected $coverId;

    /**
     * @var string|null
     */
    protected $teaserProductId;

    /**
     * @var EEComTeamTranslationCollection|null
     */
    protected $translations;

    /**
     * @var array|null
     */
    protected $customFields;

    /**
     * @var CategoryEntity|null
     */
    protected $category;

    /**
     * @var ProductStreamEntity|null
     */
    protected $productStream;

    /**
     * @var MediaEntity|null
     */
    protected $cover;

    /**
     * @var MediaCollection|null
     */
    protected $media;

    /**
     * @var ProductCollection|null
     */
    protected $products;

    /**
     * @var EEComClubTeamEntity|null
     */
    protected $teamClub;

    /**
     * @var EEComLeagueEntity|null
     */
    protected $league;

    /**
     * @var EEComLeagueRegionEntity|null
     */
    protected $leagueRegion;

    /**
     * @var EEComTeamPlayerCollection|null
     */
    protected $players;

    /**
     * @var ProductEntity|null
     */
    protected $teaserProduct;

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @param string $categoryId
     */
    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
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
     * @return string
     */
    public function getProfession(): string
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession(string $profession): void
    {
        $this->profession = $profession;
    }

    /**
     * @return string
     */
    public function getSportType(): string
    {
        return $this->sportType;
    }

    /**
     * @param string $sportType
     */
    public function setSportType(string $sportType): void
    {
        $this->sportType = $sportType;
    }

    /**
     * @return string
     */
    public function getTeamType(): string
    {
        return $this->teamType;
    }

    /**
     * @param string $teamType
     */
    public function setTeamType(string $teamType): void
    {
        $this->teamType = $teamType;
    }

    /**
     * @return string|null
     */
    public function getLeagueId(): ?string
    {
        return $this->leagueId;
    }

    /**
     * @param string|null $leagueId
     */
    public function setLeagueId(?string $leagueId): void
    {
        $this->leagueId = $leagueId;
    }

    /**
     * @return string|null
     */
    public function getLeagueRegionId(): ?string
    {
        return $this->leagueRegionId;
    }

    /**
     * @param string|null $leagueRegionId
     */
    public function setLeagueRegionId(?string $leagueRegionId): void
    {
        $this->leagueRegionId = $leagueRegionId;
    }

    /**
     * @return string|null
     */
    public function getGroundName(): ?string
    {
        return $this->groundName;
    }

    /**
     * @param string|null $groundName
     */
    public function setGroundName(?string $groundName): void
    {
        $this->groundName = $groundName;
    }

    /**
     * @return string|null
     */
    public function getTeamDescription(): ?string
    {
        return $this->teamDescription;
    }

    /**
     * @param string|null $teamDescription
     */
    public function setTeamDescription(?string $teamDescription): void
    {
        $this->teamDescription = $teamDescription;
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
     * @return string|null
     */
    public function getCoverId(): ?string
    {
        return $this->coverId;
    }

    /**
     * @param string|null $coverId
     */
    public function setCoverId(?string $coverId): void
    {
        $this->coverId = $coverId;
    }

    /**
     * @return string|null
     */
    public function getTeaserProductId(): ?string
    {
        return $this->teaserProductId;
    }

    /**
     * @param string|null $teaserProductId
     */
    public function setTeaserProductId(?string $teaserProductId): void
    {
        $this->teaserProductId = $teaserProductId;
    }

    /**
     * @return EEComTeamTranslationCollection|null
     */
    public function getTranslations(): ?EEComTeamTranslationCollection
    {
        return $this->translations;
    }

    /**
     * @param EEComTeamTranslationCollection $translations
     */
    public function setTranslations(EEComTeamTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    /**
     * @return array|null
     */
    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    /**
     * @param array|null $customFields
     */
    public function setCustomFields(?array $customFields): void
    {
        $this->customFields = $customFields;
    }

    /**
     * @return CategoryEntity|null
     */
    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    /**
     * @param CategoryEntity|null $category
     */
    public function setCategory(?CategoryEntity $category): void
    {
        $this->category = $category;
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
     * @return MediaEntity|null
     */
    public function getCover(): ?MediaEntity
    {
        return $this->cover;
    }

    /**
     * @param MediaEntity|null $cover
     */
    public function setCover(?MediaEntity $cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return MediaCollection|null
     */
    public function getMedia(): ?MediaCollection
    {
        return $this->media;
    }

    /**
     * @param MediaCollection $media
     */
    public function setMedia(MediaCollection $media): void
    {
        $this->media = $media;
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
     * @return EEComClubTeamEntity|null
     */
    public function getTeamClub(): ?EEComClubTeamEntity
    {
        return $this->teamClub;
    }

    /**
     * @param EEComClubTeamEntity|null $teamClub
     */
    public function setTeamClub(?EEComClubTeamEntity $teamClub): void
    {
        $this->teamClub = $teamClub;
    }

    /**
     * @return EEComLeagueEntity|null
     */
    public function getLeague(): ?EEComLeagueEntity
    {
        return $this->league;
    }

    /**
     * @param EEComLeagueEntity|null $league
     */
    public function setLeague(?EEComLeagueEntity $league): void
    {
        $this->league = $league;
    }

    /**
     * @return EEComLeagueRegionEntity|null
     */
    public function getLeagueRegion(): ?EEComLeagueRegionEntity
    {
        return $this->leagueRegion;
    }

    /**
     * @param EEComLeagueRegionEntity|null $leagueRegion
     */
    public function setLeagueRegion(?EEComLeagueRegionEntity $leagueRegion): void
    {
        $this->leagueRegion = $leagueRegion;
    }

    /**
     * @return EEComTeamPlayerCollection|null
     */
    public function getPlayers(): ?EEComTeamPlayerCollection
    {
        return $this->players;
    }

    /**
     * @param EEComTeamPlayerCollection $players
     */
    public function setPlayers(EEComTeamPlayerCollection $players): void
    {
        $this->players = $players;
    }

    /**
     * @return ProductEntity|null
     */
    public function getTeaserProduct(): ?ProductEntity
    {
        return $this->teaserProduct;
    }

    /**
     * @param ProductEntity|null $teaserProduct
     */
    public function setTeaserProduct(?ProductEntity $teaserProduct): void
    {
        $this->teaserProduct = $teaserProduct;
    }
}
