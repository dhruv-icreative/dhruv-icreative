import template from './eecom-club-detail-team-assignment.html.twig';
import './eecom-club-detail-team-assignment.scss';

const { Component, Mixin } = Shopware;
const { EntityCollection, Criteria } = Shopware.Data;
const { mapGetters, mapState } = Shopware.Component.getComponentHelper();

Component.register('eecom-club-detail-team-assignment', {
    template,

    mixins: [
        Mixin.getByName('placeholder')
    ],

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {
            assignedTeamIds: [],
            gridData: []
        };
    },

    computed: {
        ...mapState('eecomClubDetail', [
            'club'
        ]),

        ...mapGetters('eecomClubDetail', [
            'isLoading'
        ]),

        clubTeamRepository() {
            return this.repositoryFactory.create('eecom_club_team');
        },

        teamRepository() {
            return this.repositoryFactory.create('eecom_team');
        },

        teamColumns() {
            return [
                {
                    property: 'team.name',
                    dataIndex: 'team.name',
                    label: this.$tc('eecom-club.detailTeamAssignment.columnNameLabel'),
                    routerLink: 'eecom.team.detail',
                    sortable: false
                },
                {
                    property: 'team.active',
                    label: this.$tc('eecom-club.detailTeamAssignment.columnActiveLabel'),
                    sortable: false
                }
            ]
        },

        teams: {
            get() {
                if (this.club.teams) {
                    return this.club.teams.map(team => team.eecomTeamId)
                }

                return this.club.teams.map(team => team.eecomTeamId);
            },

            set(value) {
                if (!this.club.teams) {
                    this.club.teams = new EntityCollection('/eecom-club-team', 'eecom_club_team', Shopware.Context.api, null, []);
                }

                const values = Array.from(value);

                // Add newly added
                values.forEach((teamId) => {
                    const found = this.club.teams.find(team => team.eecomTeamId === teamId);

                    if (found) {
                        return;
                    }

                    const newTeam = this.clubTeamRepository.create(Shopware.Context.api);
                    newTeam.eecomClubId = this.club.id;
                    newTeam.eecomTeamId = teamId;

                    this.club.teams.add(newTeam);
                });

                // Remove previously added
                this.club.teams.filter(clubTeam => !values.includes(clubTeam.eecomTeamId))
                    .forEach((clubTeam) => {
                        this.club.teams.remove(clubTeam.id);
                    })
            }
        },

        clubTeamCriteria() {
            const clubTeamCriteria = new Criteria();

            if(this.assignedTeamIds.length) {
                clubTeamCriteria.addFilter(
                    Criteria.not('AND', [Criteria.equalsAny('id', this.assignedTeamIds)])
                );
            }

            return clubTeamCriteria;
        },

        searchCriteria() {
            const searchCriteria = new Criteria();

            searchCriteria.addFilter(
                Criteria.not('AND', [Criteria.equals('eecomClubId', this.$route.params.id)])
            );

            return searchCriteria;
        }
    },

    mounted() {
        this.clubTeamRepository.search(this.searchCriteria, Shopware.Context.api).then((data) => {
            this.assignedTeamIds = data.map((team) => team.eecomTeamId);
        })
    },

    created() {
        this.createdComponent();
    },

    watch: {
        teams() {
            this.loadEntityData();
        }
    },

    methods: {
        createdComponent() {
            this.loadEntityData();
        },

        loadEntityData() {
            this.clubTeamRepository.search(this.teamCriteria(), Shopware.Context.api).then((assignedTeams) => {
                this.gridData = assignedTeams;
            });
        },

        teamCriteria() {
            const teamCriteria = new Criteria(1, 10);
            teamCriteria.getAssociation('team');
            teamCriteria.addFilter(Criteria.equals('eecomClubId', this.$route.params.id));

            return teamCriteria;
        }
    }
});
