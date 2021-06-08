import './component/eecom-club-data-basic-info';
import './component/eecom-club-design-info';
import './component/eecom-club-image';
import './view/eecom-club-detail-club-data';
import './view/eecom-club-detail-club-design';
import './view/eecom-club-detail-team-assignment';
import './page/eecom-club-list';
import './page/eecom-club-detail';
import './page/eecom-club-create';
import deDE from './snippet/de-DE.json';
import enGB from './snippet/en-GB.json';

const { Module } = Shopware;

Module.register('eecom-club', {
    type: 'plugin',
    name: 'club',
    title: 'eecom-club.general.mainMenuItemGeneral',
    description: 'eecom-club.general.descriptionTextModule',
    color: '#70fffc',
    icon: 'default-object-shield',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        index: {
            component: 'eecom-club-list',
            path: 'index'
        },

        create: {
            component: 'eecom-club-detail',
            path: 'create',
            meta: {
                parentPath: 'eecom.club.index'
            },
            redirect: {
                name: 'eecom.club.create.clubData'
            },
            children: {
                clubData: {
                    component: 'eecom-club-detail-club-data',
                    path: 'club-data',
                    meta: {
                        parentPath: 'eecom.club.index'
                    }
                }
            }
        },

        detail: {
            component: 'eecom-club-detail',
            path: 'detail/:id?',
            props: {
                default: (route) => ({ clubId: route.params.id })
            },
            meta: {
                parentPath: 'eecom.club.index'
            },
            redirect: {
                name: 'eecom.club.detail.clubData'
            },
            children: {
                clubData: {
                    component: 'eecom-club-detail-club-data',
                    path: 'club-data',
                    meta: {
                        parentPath: 'eecom.club.index'
                    }
                },
                clubDesign: {
                    component: 'eecom-club-detail-club-design',
                    path: 'club-design',
                    meta: {
                        parentPath: 'eecom.club.index'
                    }
                },
                teamAssignment: {
                    component: 'eecom-club-detail-team-assignment',
                    path: 'team-assignment',
                    meta: {
                        parentPath: 'eecom.club.index'
                    }
                }
            }
        }
    },

    navigation: [{
        id: 'eecom-club-shop',
        label: 'eecom-club.general.mainMenuItemNavigation',
        color: '#70fffc',
        icon: 'default-object-shield-full',
        position: 71,
    }, {
        id: 'eecom-club',
        path: 'eecom.club.index',
        label: 'eecom-club.general.mainMenuItemGeneral',
        color: '#70fffc',
        icon: 'default-object-shield',
        position: 10,
        parent: 'eecom-club-shop'
    }]
});
