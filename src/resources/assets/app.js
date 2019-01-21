const vm = new Vue({
    el: '#sm-app',
    created() {
        this.load();
    },
    data() {
        return {
            users: [],
        }
    },
    methods: {
        'load': async function () {
            axios.get(sm_config.route_get_sessions).then(response => {
                this.users = response.data.data;
            });
        },
        'remove': async function (session) {
            console.log(session.id);
            if (confirm(sm_config.confirm_msg)) {
                axios.delete(sm_config.route_destroy_session + session.user.id).then(response => {
                    alert(response.data.status);
                    this.load();
                }).catch(error=>{
                    alert(error.data.message);
                })
            }

        }
    }
});

