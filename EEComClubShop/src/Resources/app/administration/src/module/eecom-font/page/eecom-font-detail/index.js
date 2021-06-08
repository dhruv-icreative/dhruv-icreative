import template from './eecom-font-detail.html.twig';

const { Component, Mixin } = Shopware;
const { mapPropertyErrors } = Shopware.Component.getComponentHelper();

Component.register('eecom-font-detail', {
    template,

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory',
        'pluginService'
    ],

    props: {
        fontId: {
            type: String,
            required: false,
            default: null
        }
    },

    data() {
        return {
            font: null,
            file: null,
            isLoading: false,
            processSuccess: false
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle(this.fontTitle)
        };
    },

    computed: {
        allowedFileTypes() {
            return [
                'font/woff',
                'font/ttf'
            ];
        },
        ...mapPropertyErrors('font', [
            'name'
        ]),

        fontRepository() {
            return this.repositoryFactory.create('eecom_font');
        },

        fontTitle() {
            return this.placeholder(this.font, 'name', this.fontId ? '' : this.$tc('eecom-font.detail.textHeadline'));
        }
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.font = this.fontRepository.create(Shopware.Context.api);

            if(this.fontId) {
                return this.getFont();
            }
        },

        getFont() {
            this.isLoading = true;

            this.fontRepository
                .get(this.$route.params.id, Shopware.Context.api)
                .then((entity) => {
                    this.font = entity;
                    this.isLoading = false;
                });
        },

        onClickSave() {
            this.isLoading = true;

            let headers = this.pluginService.getBasicHeaders();
            let data = new FormData();

            data.append('file', this.file);

            headers = {
                ...headers,
                'Content-Type' : 'multipart/form-data'
            }

            this.pluginService.httpClient
                .post('/eecom/upload/font', data, {headers})
                .then((response) => {
                    if(response.data.status === 'success') {
                        this.font.fileName = response.data.fileName;
                        this.font.fileType = response.data.fileExtension;

                        this.fontRepository
                            .save(this.font, Shopware.Context.api)
                            .then(() => {
                                if(this.fontId) {
                                    this.getFont();
                                }
                                else {
                                    this.$router.push({ name: 'eecom.font.detail', params: { id: this.font.id } });
                                }
                                this.isLoading = false;
                                this.processSuccess = true;
                            }).catch((exception) => {
                            this.isLoading = false;
                            this.createNotificationError({
                                title: this.$t('eecom-font.detail.errorTitle'),
                                message: exception
                            });
                        });
                    }
                    else {
                        if(this.font.fontUrl === null || this.font.fontUrl === undefined || this.font.fontUrl === '') {
                            this.isLoading = false;
                            this.createNotificationError({
                                title: this.$t('eecom-font.detail.errorTitle'),
                                message: this.$t('eecom-font.detail.emptyFieldErrorMessage')
                            });
                        }
                        else {
                            this.fontRepository
                                .save(this.font, Shopware.Context.api)
                                .then(() => {
                                    if(this.fontId) {
                                        this.getFont();
                                    }
                                    else {
                                        this.$router.push({ name: 'eecom.font.detail', params: { id: this.font.id } });
                                    }
                                    this.isLoading = false;
                                    this.processSuccess = true;
                                }).catch((exception) => {
                                this.isLoading = false;
                                this.createNotificationError({
                                    title: this.$t('eecom-font.detail.errorTitle'),
                                    message: exception
                                });
                            });
                        }
                    }
                });
        },

        saveFinish() {
            this.processSuccess = false;
        },

        handleFileUpload(data) {
            let file = data || null;

            /*if(!file) {
                return;
            }*/

            this.file = file;
        }
    }
});
