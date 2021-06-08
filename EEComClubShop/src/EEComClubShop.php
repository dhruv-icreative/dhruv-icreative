<?php declare(strict_types=1);

namespace EECom\ClubShop;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class EEComClubShop extends Plugin
{
    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);

        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_team_translation`');
        $connection->executeQuery('ALTER TABLE `product` DROP COLUMN `teamProducts`');
        $connection->executeQuery('ALTER TABLE `product` DROP COLUMN `playerProducts`');
        $connection->executeQuery('ALTER TABLE `product` DROP COLUMN `playerShoeProducts`');
        $connection->executeQuery('ALTER TABLE `product` DROP COLUMN `teaserProducts`');
        $connection->executeQuery('ALTER TABLE `category` DROP COLUMN `teamCategory`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_player_product`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_team_product`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_team_media`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_player_team_position`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_player_playing_position_2`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_player_playing_position_1`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_playing_position`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_player_shoe`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_team_player`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_player`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_club_team`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_team`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_league_region`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_league`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_club_translation`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_club_media`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_club`');
        $connection->executeQuery('DROP TABLE IF EXISTS `eecom_font`');
    }
}
