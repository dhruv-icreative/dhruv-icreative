import './component/eecom-entity-single-select';
import './component/eecom-team-image';
import './view/eecom-team-detail-player-assignment';
import './view/eecom-team-detail-product-assignment';
import './view/eecom-team-detail-team-data';
import './page/eecom-team-list';
import './page/eecom-team-detail';
import deDE from "./snippet/de-DE.json";
import enGB from "./snippet/en-GB.json";

const { Module } = Shopware;

Module.register('eecom-team', {
    type: 'plugin',
    name: 'team',
    title: 'eecom-team.general.mainMenuItemGeneral',
    description: 'eecom-team.general.descriptionTextModule',
    color: '#70fffc',
    icon: 'default-object-shield',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        index: {
            component: 'eecom-team-list',
            path: 'index'
        },

        create: {
            component: 'eecom-team-detail',
            path: 'create',
            meta: {
                parentPath: 'eecom.team.index'
            },
            redirect: {
                name: 'eecom.team.create.teamData'
            },
            children: {
                teamData: {
                    component: 'eecom-team-detail-team-data',
                    path: 'team-data',
                    meta: {
                        parentPath: 'eecom.team.index'
                    }
                }
            }
        },

        detail: {
            component: 'eecom-team-detail',
            path: 'detail/:id?',
            props: {
                default: (route) => ({ teamId: route.params.id })
            },
            meta: {
                parentPath: 'eecom.team.index'
            },
            redirect: {
                name: 'eecom.team.detail.teamData'
            },
            children: {
                teamData: {
                    component: 'eecom-team-detail-team-data',
                    path: 'team-data',
                    meta: {
                        parentPath: 'eecom.team.index'
                    }
                },
                playerAssignment: {
                    component: 'eecom-team-detail-player-assignment',
                    path: 'player-assignment',
                    meta: {
                        parentPath: 'eecom.team.index'
                    }
                },
                productAssignment: {
                    component: 'eecom-team-detail-product-assignment',
                    path: 'product-assignment',
                    meta: {
                        parentPath: 'eecom.team.index'
                    }
                }
            }
        }
    },

    navigation: [{
        id: 'eecom-team',
        path: 'eecom.team.index',
        label: 'eecom-team.general.mainMenuItemGeneral',
        color: '#70fffc',
        icon: 'default-object-shield',
        position: 20,
        parent: 'eecom-club-shop'
    }]
});
