import './page/eecom-font-detail';
import './page/eecom-font-list';
import deDE from "./snippet/de-DE.json";
import enGB from "./snippet/en-GB.json";

const { Module } = Shopware;

Module.register('eecom-font', {
    type: 'plugin',
    name: 'font',
    title: 'eecom-font.general.mainMenuItemGeneral',
    description: 'eecom-font.general.descriptionTextModule',
    color: '#70fffc',
    icon: 'default-object-shield',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: {
        index: {
            component: 'eecom-font-list',
            path: 'index'
        },

        create: {
            component: 'eecom-font-detail',
            path: 'create',
            meta: {
                parentPath: 'eecom.font.index'
            }
        },

        detail: {
            component: 'eecom-font-detail',
            path: 'detail/:id?',
            props: {
                default: (route) => ({ fontId: route.params.id })
            },
            meta: {
                parentPath: 'eecom.font.index'
            }
        }
    },

    navigation: [{
        id: 'eecom-font',
        path: 'eecom.font.index',
        label: 'eecom-font.general.mainMenuItemGeneral',
        color: '#70fffc',
        icon: 'default-object-shield',
        position: 40,
        parent: 'eecom-club-shop'
    }]
});
