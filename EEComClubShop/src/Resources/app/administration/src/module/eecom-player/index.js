import './component/icons-house-of-clubs';
import './view/eecom-player-detail-player-data';
import './view/eecom-player-detail-team-club-data';
import './view/eecom-player-detail-product-assignment';
import './page/eecom-player-create';
import './page/eecom-player-list';
import './page/eecom-player-detail';
import deDE from "./snippet/de-DE.json";
import enGB from "./snippet/en-GB.json";

const { Module } = Shopware;

Module.register('eecom-player', {
    type: 'plugin',
    name: 'player',
    title: 'eecom-player.general.mainMenuItemGeneral',
    description: 'eecom-player.general.descriptionTextModule',
    color: '#70fffc',
    icon: 'default-object-shield',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        index: {
            component: 'eecom-player-list',
            path: 'index'
        },

        create: {
            component: 'eecom-player-detail',
            path: 'create',
            meta: {
                parentPath: 'eecom.player.index'
            },
            redirect: {
                name: 'eecom.player.create.playerData'
            },
            children: {
                playerData: {
                    component: 'eecom-player-detail-player-data',
                    path: 'player-data',
                    meta: {
                        parentPath: 'eecom.player.index'
                    }
                }
            }
        },

        detail: {
            component: 'eecom-player-detail',
            path: 'detail/:id?',
            props: {
                default: (route) => ({ playerId: route.params.id })
            },
            meta: {
                parentPath: 'eecom.player.index'
            },
            redirect: {
                name: 'eecom.player.detail.playerData'
            },
            children: {
                playerData: {
                    component: 'eecom-player-detail-player-data',
                    path: 'player-data',
                    meta: {
                        parentPath: 'eecom.player.index'
                    }
                },
                teamClubData: {
                    component: 'eecom-player-detail-team-club-data',
                    path: 'team-club-data',
                    meta: {
                        parentPath: 'eecom.player.index'
                    }
                },
                productAssignment: {
                    component: 'eecom-player-detail-product-assignment',
                    path: 'product-assignment',
                    meta: {
                        parentPath: 'eecom.player.index'
                    }
                }
            }
        }
    },

    navigation: [{
        id: 'eecom-player',
        path: 'eecom.player.index',
        label: 'eecom-player.general.mainMenuItemGeneral',
        color: '#70fffc',
        icon: 'default-object-shield',
        position: 30,
        parent: 'eecom-club-shop'
    }]
});
