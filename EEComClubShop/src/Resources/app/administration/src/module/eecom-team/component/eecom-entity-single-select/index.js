const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.extend('eecom-entity-single-select', 'sw-entity-single-select', {
    data() {
        return {
            termExists: true
        };
    },

    methods: {
        resetActiveItem(position = 0) {
            // Return if the result list is closed before the search request returns
            if (!this.$refs.resultsList) {
                return;
            }
            // If an item is selected the second entry is the first search result
            if (this.singleSelection) {
                position = 1;
            }
            this.$refs.resultsList.setActiveItemIndex(position);
        },

        search(searchTerm) {
            this.filterSearchGeneratedTags();

            Promise.all([this.checkTermExists(this.searchTerm), this.$super('search', searchTerm)]).then(() => {

                if(!this.termExists) {
                    const newTerm = this.repository.create(this.entity.context, -1);
                    newTerm.name = this.$tc('eecom-team.detail.listItemAdd', 0, {term: this.searchTerm});

                    this.resultCollection.unshift(newTerm);
                    this.$nextTick(this.resetActiveItem);
                }
            });
        },

        setValue(item) {
            if (item.id === -1) {
                this.createNewTag();
            } else {
                this.$super('setValue', item);
            }
        },

        createNewTag() {
            const item = this.repository.create(this.context);
            item.name = this.searchTerm;
            this.repository.save(item, this.context).then(() => {
                this.setValue(item);

                // Reset criteria and all parameter to get a clean new result after an item has been added
                this.criteria.setPage(1);
                this.criteria.setLimit(this.resultLimit);
                this.criteria.setTerm('');
                this.searchTerm = '';
                this.resultCollection = null;

                this.loadData().then(() => {
                    this.resetActiveItem();
                });
            });
        },

        checkTermExists(term) {
            if(term.trim().length === 0) {
                this.termExists = true;
                return Promise.resolve();
            }

            const criteria = new Criteria();
            criteria.addFilter(
                Criteria.equals('name', term)
            );

            return this.repository.search(criteria, this.context).then((response) => {
                this.termExists = response.total > 0;
            })
        },

        filterSearchGeneratedTags() {
            this.resultCollection = this.resultCollection.filter(entity => {
                return entity.id !== -1;
            });
        }
    }
});
