const { Component } = Shopware;

Component.extend('eecom-team-create', 'eecom-team-detail', {
    methods: {
        getTeam() {
            this.team = this.repository.create(Shopware.Context.api);
        },

        onClickSave() {
            this.isLoading = true;

            this.repository
                .save(this.team, Shopware.Context.api)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({ name: 'eecom.team.detail', params: { id: this.team.id } });
                }).catch((exception) => {
                    this.isLoading = false;

                    this.createNotificationError({
                        title: this.$t('eecom-team.detail.errorTitle'),
                        message: exception
                    });
                });
        }
    }
});
