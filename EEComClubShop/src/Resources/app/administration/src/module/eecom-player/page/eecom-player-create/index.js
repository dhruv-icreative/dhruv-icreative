const { Component } = Shopware;

Component.extend('eecom-player-create', 'eecom-player-detail', {
    methods: {
        getPlayer() {
            this.player = this.repository.create(Shopware.Context.api);
        },

        onClickSave() {
            this.isLoading = true;

            this.repository
                .save(this.player, Shopware.Context.api)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({name: 'eecom.player.detail', params: {id: this.player.id}});
                }).catch((exception) => {
                this.isLoading = false;

                this.createNotificationError({
                    title: this.$t('eecom-player.detail.errorTitle'),
                    message: exception
                });
            });
        }
    }
});
