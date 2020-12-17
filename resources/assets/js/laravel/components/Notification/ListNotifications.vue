<template>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
        <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
            Notifications
        </div>
        <ul class="nav-items my-2">
            <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                    <div class="mx-3">
                        <i class="fa fa-fw fa-check-circle text-success"></i>
                    </div>
                    <div class="media-body font-size-sm pr-2">
                        <div class="font-w600">App was updated to v5.6!</div>
                        <div class="text-muted font-italic">3 min ago</div>
                    </div>
                </a>
            </li>
            <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                    <div class="mx-3">
                        <i class="fa fa-fw fa-user-plus text-info"></i>
                    </div>
                    <div class="media-body font-size-sm pr-2">
                        <div class="font-w600">New Subscriber was added! You now have 2580!</div>
                        <div class="text-muted font-italic">10 min ago</div>
                    </div>
                </a>
            </li>
            <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                    <div class="mx-3">
                        <i class="fa fa-fw fa-times-circle text-danger"></i>
                    </div>
                    <div class="media-body font-size-sm pr-2">
                        <div class="font-w600">Server backup failed to complete!</div>
                        <div class="text-muted font-italic">30 min ago</div>
                    </div>
                </a>
            </li>
            <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                    <div class="mx-3">
                        <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                    </div>
                    <div class="media-body font-size-sm pr-2">
                        <div class="font-w600">You are running out of space. Please consider upgrading your plan.</div>
                        <div class="text-muted font-italic">1 hour ago</div>
                    </div>
                </a>
            </li>
            <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                    <div class="mx-3">
                        <i class="fa fa-fw fa-plus-circle text-primary"></i>
                    </div>
                    <div class="media-body font-size-sm pr-2">
                        <div class="font-w600">New Sale! + $30</div>
                        <div class="text-muted font-italic">2 hours ago</div>
                    </div>
                </a>
            </li>
            <li v-for="notification in notifications" :key="notification.id">
                <notification :notification="notification"></notification>
            </li>
        </ul>
        <div class="p-2 border-top">
            <a class="btn btn-light btn-block text-center" href="javascript:void(0)">
                <i class="fa fa-fw fa-eye mr-1"></i> View All
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object
        },
        data() {
            return {
                notifications: [],
            }
        },
        created() {
            this.fetchNotifications();

            if (window.Echo) {
                Echo.private('notify.all')
                    .listen('.new', (event) => {
                        this.notifications.push(event.notification);
                    })
                Echo.private('notify.user.' + this.user.id)
                    .listen('.new', (event) => {
                        this.notifications.push(event.notification);
                    })
            }
        },
        methods: {
            fetchNotifications() {
                axios.get(SERVER_URL + '/notifications/global').then(response => {
                    this.notifications = this.notifications.concat(response.data);
                    axios.post(SERVER_URL + '/notifications/user', {
                        user_id: this.user.id
                    }).then(response => {
                        this.notifications = this.notifications.concat(response.data);
                    })
                })
            }
        }
    }
</script>
