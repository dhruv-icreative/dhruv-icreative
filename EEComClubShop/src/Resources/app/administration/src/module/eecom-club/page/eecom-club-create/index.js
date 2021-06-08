const { Component } = Shopware;

Component.extend('eecom-team-create', 'eecom-club-detail', {
    methods: {
        getClub() {
            this.club = this.repository.create(Shopware.Context.api);
        },

        onClickSave() {
            this.isLoading = true;

            this.repository
                .save(this.club, Shopware.Context.api)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({ name: 'eecom.club.detail', params: { id: this.club.id } });
                }).catch((exception) => {
                    this.isLoading = false;

                    this.createNotificationError({
                        title: this.$t('eecom-club.detail.errorTitle'),
                        message: exception
                    });
                });
        }
    }
});
