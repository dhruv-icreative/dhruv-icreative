import template from './eecom-team-detail-player-assignment.html.twig';
import './eecom-team-detail-player-assignment.scss';

const { Component, Mixin } = Shopware;
const { EntityCollection, Criteria } = Shopware.Data;
const { mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-team-detail-player-assignment', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            assignedPlayerIds: [],
            gridData: []
        };
    },

    mounted() {
        this.teamPlayerRepository.search(this.searchCriteria, Shopware.Context.api).then((data) => {
            this.assignedPlayerIds = data.map((player) => player.eecomPlayerId);
        });
    },

    computed: {
        ...mapState('eecomTeamDetail', [
            'team'
        ]),

        ...mapGetters('eecomTeamDetail', [
            'isLoading'
        ]),

        teamPlayerRepository() {
            return this.repositoryFactory.create('eecom_team_player');
        },

        playerRepository() {
            return this.repositoryFactory.create('eecom_player');
        },

        playerColumns() {
            return [
                {
                    property: 'player.lastName',
                    dataIndex: 'player.lastName',
                    label: this.$tc('eecom-team.detailPlayerAssignment.columnLastNameLabel'),
                    routerLink: 'eecom.player.detail',
                    sortable: false
                },
                {
                    property: 'player.firstName',
                    dataIndex: 'player.firstName',
                    label: this.$tc('eecom-team.detailPlayerAssignment.columnFirstNameLabel'),
                    routerLink: 'eecom.player.detail',
                    sortable: false
                },
                {
                    property: 'player.favouritePlayerNumber',
                    dataIndex: 'player.favouritePlayerNumber',
                    label: this.$tc('eecom-team.detailPlayerAssignment.columnFavouritePlayerNumberLabel'),
                    sortable: false
                }
            ];
        },

        players: {
            get() {
                // if (this.team.players) {
                //     return this.team.players.map(player => player.eecomPlayerId)
                // }

                return this.team.players.map(player => player.eecomPlayerId);
            },

            set(value) {
                if (!this.team.players) {
                    this.team.players = new EntityCollection('/eecom-team-player', 'eecom_team_player', Shopware.Context.api, null, []);
                }

                const values = Array.from(value);

                // Add newly added
                values.forEach((playerId) => {
                    const found = this.team.players.find(player => player.eecomPlayerId === playerId);

                    if (found) {
                        return;
                    }

                    const newPlayer = this.teamPlayerRepository.create(Shopware.Context.api);
                    newPlayer.eecomTeamId = this.team.id;
                    newPlayer.eecomPlayerId = playerId;

                    this.team.players.add(newPlayer);
                });

                // Remove previously added
                this.team.players.filter(teamPlayer => !values.includes(teamPlayer.eecomPlayerId))
                    .forEach((teamPlayer) => {
                    this.team.players.remove(teamPlayer.id);
                })
            }
        },

        teamPlayerCriteria() {
            /*console.log(typeof(this.assignedPlayerIds));
            console.log(this.assignedPlayerIds);*/

            const teamPlayerCriteria = new Criteria();

            if(this.assignedPlayerIds.length) {
                teamPlayerCriteria.addFilter(
                    Criteria.not('AND', [Criteria.equalsAny('id', this.assignedPlayerIds)])
                );
            }

            return teamPlayerCriteria;
        },

        searchCriteria() {
            const searchCriteria = new Criteria();

            searchCriteria.addFilter(
                Criteria.not('AND', [Criteria.equals('eecomTeamId', this.$route.params.id)])
            );

            return searchCriteria;
        }
    },

    created() {
        this.createdComponent();
    },

    watch: {
        players() {
            this.loadPlayerData();
        }
    },

    methods: {
        createdComponent() {
            this.loadPlayerData();
        },

        loadPlayerData() {
            this.teamPlayerRepository.search(this.playerCriteria(), Shopware.Context.api).then((assignedPlayers) => {
                /*console.log(assignedPlayers);*/
                this.gridData = assignedPlayers;
            });
        },

        playerCriteria() {
            const playerCriteria = new Criteria();
            playerCriteria.getAssociation('player');
            playerCriteria.addFilter(Criteria.equals('eecomTeamId', this.$route.params.id));

            return playerCriteria;
        }
    }
});
