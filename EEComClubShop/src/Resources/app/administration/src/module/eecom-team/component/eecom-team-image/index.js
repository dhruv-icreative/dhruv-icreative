import template from './eecom-team-image.html.twig';
import './eecom-team-image.scss';

const { Component } = Shopware;

Component.register('eecom-team-image', {
    template,

    props: {
        mediaId: {
            type: String,
            required: true
        },

        isCover: {
            type: Boolean,
            required: false,
            default: false
        },

        isPlaceholder: {
            type: Boolean,
            required: false,
            default: false
        }
    },

    computed: {
        teamImageClasses() {
            return {
                'is--placeholder': this.isPlaceholder,
                'is--cover': this.isCover
            };
        }
    }
});
