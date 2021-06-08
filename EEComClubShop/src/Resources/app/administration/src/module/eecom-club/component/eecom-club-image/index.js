import template from './eecom-club-image.html.twig';
import './eecom-club-image.scss';

const { Component } = Shopware;

Component.register('eecom-club-image', {
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
        clubImageClasses() {
            return {
                'is--placeholder': this.isPlaceholder,
                'is--cover': this.isCover
            };
        }
    }
})
